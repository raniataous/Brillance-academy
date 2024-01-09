<?php
/**
 * Class LP_Addon_WPML_Hooks
 *
 * @since 4.0.6
 * @version  1.0.0
 * @author thimpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class LP_Prere_Course_Hooks {
	/**
	 * @var bool|LP_User|LP_User_Guest
	 */
	protected $user_current;

	/**
	 * @return LP_Prere_Course_Hooks
	 */
	public static function get_instance(): LP_Prere_Course_Hooks {
		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * LP_Prere_Hooks constructor.
	 */
	protected function __construct() {
		$this->user_current = learn_press_get_current_user();
		$this->init();
	}

	private function init() {
		// Hook add styles
		add_action( 'learn-press/frontend-default-styles', array( $this, 'enqueue_styles' ) );
		// Hook meta box
		add_filter( 'lp/course/meta-box/fields/general', array( $this, 'admin_meta_box' ), 11 );
		// Hook check condition show message.
		add_action( 'learn-press/course-buttons', array( $this, 'check_condition' ), 1 );
		// Hook check can enroll course
		add_filter( 'learn-press/user/can-enroll-course', array( $this, 'can_enroll_course' ), 99, 3 );
		// Hook check can buy course
		add_filter( 'learn-press/user/can-purchase-course', array( $this, 'can_purchase_course' ), 99, 3 );
		// Hook check can view content course
		add_filter( 'learnpress/course/can-view-content', array( $this, 'can_view_content_course' ), 99, 3 );
	}

	/**
	 * Equeue assets.
	 *
	 * @param array $styles
	 *
	 * @return array
	 */
	public function enqueue_styles( array $styles = [] ): array {
		/**
		 * @var LP_Addon_Prerequisites_Courses $lp_addon_prerequisites_courses
		 */
		global $lp_addon_prerequisites_courses;

		$url = $lp_addon_prerequisites_courses->get_plugin_url( 'assets/css/lp-prerequisite-course.css' );
		if ( LP_Debug::is_debug() ) {
			$url = $lp_addon_prerequisites_courses->get_plugin_url( 'assets/css/lp-prerequisite-course.css' );
		}

		$styles['lp-prerequisites-courses'] = new LP_Asset_Key( $url );

		return $styles;
	}

	/**
	 * Add prerequisites courses in course meta box.
	 *
	 * @param $meta_boxes
	 *
	 * @return mixed
	 * @since 3.0.0
	 * @version 3.0.1
	 */
	public function admin_meta_box( $meta_boxes ) {
		$post_id = LP_Helper::sanitize_params_submitted( $_REQUEST['post'] ?? 0 );
		$post    = get_post( $post_id );
		if ( ! $post ) {
			return $meta_boxes;
		}
		$post_author = get_post_field( 'post_author', $post_id );

		// Get courses.
		$filter            = new LP_Course_Filter();
		$filter->max_limit = 1000;
		$filter->limit     = 1000;
		if ( ! is_super_admin() ) {
			$filter->post_author = $post_author;
		}
		$courses = LP_Course::get_courses( $filter );

		$_options = array();

		foreach ( $courses as $course ) {
			$_options[ $course->ID ] = $course->post_title;
		}

		$meta_boxes['_lp_prerequisite_allow_purchase'] = new LP_Meta_Box_Checkbox_Field(
			esc_html__( 'Allow Purchase (Prerequisite)', 'learnpress-prerequisites-courses' ),
			esc_html__( 'Allow purchase course without finish prerequisites.', 'learnpress-prerequisites-courses' ),
			'no'
		);

		$meta_boxes['_lp_course_prerequisite'] = new LP_Meta_Box_Select_Field(
			esc_html__( 'Prerequisites Courses', 'learnpress-prerequisites-courses' ),
			esc_html__( 'Courses you have to pass before you can enroll to this course.', 'learnpress-prerequisites-courses' ),
			'',
			array(
				'options'  => $_options,
				'multiple' => true,
				'style'    => 'width: 50%;',
			)
		);

		return $meta_boxes;
	}

	/**`
	 * Show notice required pass prerequisites courses.
	 *
	 * @since 3.0.0
	 * @version 3.0.1
	 * @editor tungnx
	 */
	public function check_condition() {
		global $post, $lp_addon_prerequisites_courses;

		$user   = $this->user_current;
		$course = learn_press_get_course( $post->ID );
		if ( ! $user || ! $course ) {
			return;
		}

		if ( $course->get_external_link() ) {
			return;
		}

		$user_course = $user->get_course_data( $course->get_id() );

		// Get option allow purchase course without prerequisites.
		$allow_purchase = get_post_meta( $course->get_id(), '_lp_prerequisite_allow_purchase', true );
		if ( 'yes' === $allow_purchase && ! $course->is_free() && ( ! $user_course || ! $user_course->is_enrolled() ) ) {
			return;
		}

		// get prerequisites of course
		$required_course_ids = LP_Addon_Prerequisites_Courses::get_prerequisite_courses( $post->ID );
		if ( empty( $required_course_ids ) ) {
			return;
		}

		$courses_not_passed = array();
		$users_courses      = array();

		foreach ( $required_course_ids as $required_course_id ) {
			if ( empty( $required_course_id ) ) {
				continue;
			}

			$user_course = $user->get_course_data( $required_course_id );

			if ( ! $user_course || 'passed' !== $user_course->get_graduation() ) {
				$courses_not_passed[] = $required_course_id;
			}

			$users_courses[] = $user_course;
		}

		if ( ! $courses_not_passed ) {
			return;
		}

		// Remove buttons course.
		remove_all_actions( 'learn-press/course-buttons' );

		$lp_addon_prerequisites_courses->get_template( 'prerequisites-message', compact( 'users_courses' ) );
	}

	/**
	 * Hook check can enroll course.
	 *
	 * @param $flag
	 * @param LP_Course $course
	 * @param bool $return_bool
	 *
	 * @return false|mixed
	 */
	public function can_enroll_course( $flag, LP_Course $course, bool $return_bool ) {
		$user = $this->user_current;

		if ( ! $user ) {
			return $flag;
		}

		$course_id = $course->get_id();

		$required_course_ids = LP_Addon_Prerequisites_Courses::get_prerequisite_courses( $course_id );
		foreach ( $required_course_ids as $required_course_id ) {
			$course_data = $user->get_course_data( $required_course_id );

			if ( ! $course_data || 'passed' !== $course_data->get_graduation() ) {
				if ( $return_bool ) {
					$flag = false;
				} else {
					$flag->check   = false;
					$flag->message = sprintf( '%s %s', __( 'You not passed course ', 'learnpress-prerequisites-courses' ), get_the_title( $required_course_id ) );
				}
				break;
			}
		}

		return $flag;
	}

	/**
	 * Hook check can buy course.
	 *
	 * @param mixed|bool $purchasable
	 * @param $user_id
	 * @param $course_id
	 *
	 * @return bool|mixed
	 */
	public function can_purchase_course( $can_purchase, $user_id, $course_id ) {
		if ( ! $can_purchase ) {
			return $can_purchase;
		}

		try {
			$user   = learn_press_get_user( $user_id );
			$course = learn_press_get_course( $course_id );
			if ( ! $user || ! $course ) {
				return $can_purchase;
			}

			$required_course_ids = LP_Addon_Prerequisites_Courses::get_prerequisite_courses( $course_id );
			// Get option allow purchase course without prerequisite
			$allow_purchase   = get_post_meta( $course_id, '_lp_prerequisite_allow_purchase', true );
			$allow_repurchase = $course->allow_repurchase();

			if ( 'yes' === $allow_purchase ) {
				// For case repurchase course
				if ( $user->has_purchased_course( $course_id ) ) {
					if ( ! empty( $allow_repurchase ) && $allow_repurchase == 'yes' ) {
						if ( $user->has_passed_course( $course_id ) ) {
							$can_purchase = true;
						}
					}
				}
			} else {
				foreach ( $required_course_ids as $required_course_id ) {
					$course_data = $user->get_course_data( $required_course_id );
					if ( ! $course_data || 'passed' !== $course_data->get_graduation() ) {
						$can_purchase = false;
						break;
					}
				}
			}
		} catch ( Throwable $e ) {
			error_log( $e->getMessage() );
		}

		return $can_purchase;
	}

	/**
	 * Filer user can view content course condition.
	 *
	 * @param LP_Model_User_Can_View_Course_Item $view
	 * @param int $user_id
	 * @param LP_Course $course
	 *
	 * @return LP_Model_User_Can_View_Course_Item
	 * @since 4.0.0
	 * @version 1.0.1
	 */
	public function can_view_content_course( LP_Model_User_Can_View_Course_Item $view, int $user_id, LP_Course $course ) {
		$user = learn_press_get_user( $user_id );
		if ( ! $user ) {
			return $view;
		}

		$course_id           = $course->get_id();
		$required_course_ids = LP_Addon_Prerequisites_Courses::get_prerequisite_courses( $course_id );

		foreach ( $required_course_ids as $required_course_id ) {
			$course_data = $user->get_course_data( $required_course_id );
			if ( ! $course_data || 'passed' !== $course_data->get_graduation() ) {
				$view->flag    = false;
				$view->message = __(
					'This content is protected, please pass the prerequisites course(s) to view this content!',
					'learnpress-prerequisites-courses'
				);
				break;
			}
		}

		return $view;
	}
}
