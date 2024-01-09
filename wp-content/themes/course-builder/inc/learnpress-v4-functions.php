<?php
// Enable override templates
add_filter( 'learn-press/override-templates', '__return_true' );

// add cusom field for course
if ( ! function_exists( 'thim_course_builder_add_custom_field_course' ) ) {
	function thim_course_builder_add_custom_field_course() {
 		lp_meta_box_text_input_field(
			array(
				'id'          => 'thim_course_media',
				'label'       => esc_html__( 'Media URL', 'course-builder' ),
				'description' => esc_html__( 'Supports 3 types of video urls: Direct video link, Youtube link, Vimeo link.', 'course-builder' ),
				'default'     => ''
			)
		);
		lp_meta_box_text_input_field(
			array(
				'id'          => 'thim_course_info_button',
				'label'       => esc_html__( 'Info Button Box', 'course-builder' ),
				'description' => esc_html__( 'Add text info button', 'course-builder' ),
				'default'     => ''
			)
		);

		lp_meta_box_textarea_field(
			array(
				'id'          => 'thim_course_includes',
				'label'       =>  esc_html__( 'Includes', 'course-builder' ),
				'description' => esc_html__( 'Includes information of Courses', 'course-builder' ),
				'default'     => '',
			)
		);
	}
}

add_action( 'learnpress/course-settings/after-general', 'thim_course_builder_add_custom_field_course' );

add_action(
	'learnpress_save_lp_course_metabox', function ( $post_id ) {
	$video         = ! empty( $_POST['thim_course_media'] ) ? $_POST['thim_course_media'] : '';
	$info_button      = ! empty( $_POST['thim_course_info_button'] ) ? $_POST['thim_course_info_button'] : '';
	$course_includes = ! empty( $_POST['thim_course_includes'] ) ? $_POST['thim_course_includes'] : '';

	update_post_meta( $post_id, 'thim_course_media', $video );
	update_post_meta( $post_id, 'thim_course_info_button', $info_button );
	update_post_meta( $post_id, 'thim_course_includes', $course_includes );
}
);

/** * Add media meta data for a lesson
 *
 * @param $meta_box
 */
function thim_add_video_lesson() {
	lp_meta_box_textarea_field(
			array(
				'id'          => '_lp_lesson_video_intro',
				'label'       => esc_html__( 'Media intro', 'course-builder' ),
				'default'     => '',
			)
		);
}
add_action( 'learnpress/lesson-settings/after', 'thim_add_video_lesson' );
add_action( 'learnpress_save_lp_lesson_metabox', function( $post_id ) {
	$video = ! empty( $_POST['_lp_lesson_video_intro'] ) ? $_POST['_lp_lesson_video_intro'] : '';

	update_post_meta( $post_id, '_lp_lesson_video_intro', $video );
} );

/**
 * Check new version of addons LearnPress Woo Payment
 *
 * @return mixed
 */
function thim_is_version_addons_woo_payment( $version ) {
	if ( defined( 'LP_ADDON_WOO_PAYMENT_VER' ) ) {
		return ( version_compare( LP_ADDON_WOO_PAYMENT_VER, $version, '>=' ) );
	}

	return false;
}

if ( ! function_exists( 'thim_remove_learnpress_hooks' ) ) {
	function thim_remove_learnpress_hooks() {

		add_action(
			'init', function () {
			if ( class_exists( 'LP_Addon_Coming_Soon_Courses' )  ) {
                $instance_addon = LP_Addon_Coming_Soon_Courses::instance();
                 remove_action( 'learn-press/course-content-summary', array( $instance_addon, 'coming_soon_countdown' ), 10 );
 //              add_action( 'learn-press-after-course-thumbnail', array( $instance_addon, 'coming_soon_countdown' ), 5 );
 				 add_action( 'learn-press-course-coming-soon-message', array( $instance_addon, 'coming_soon_message' ), 10 );
            }
			if ( class_exists( 'LP_Addon_Prerequisites_Courses' ) ) {
				$instance_addon = LP_Addon_Prerequisites_Courses::instance();
				remove_action( 'learn-press/course-buttons', array( $instance_addon, 'enroll_notice' ), 34 );
				add_action( 'learn-press/single-course-enroll-notice', array( $instance_addon, 'enroll_notice' ), 5 );
 			}
			if ( class_exists( 'LP_WC_Hooks' ) && thim_is_version_addons_woo_payment( '4.0.3' ) ) {
				$lp_woo_hoocks = LP_WC_Hooks::instance();
				add_action( 'thim-lp-course-btn_add_to_cart', array( $lp_woo_hoocks, 'btn_add_to_cart'  ) );
  			}
		}, 99 );
	}
}
add_action( 'after_setup_theme', 'thim_remove_learnpress_hooks', 15 );
// Remove Breadcrumb on Page
LearnPress::instance()->template( 'general' )->remove( 'learn-press/before-main-content', array( '<div class="lp-archive-courses">', 'lp-archive-courses-open' ), -100 );
remove_action( 'learn-press/before-main-content', LearnPress::instance()->template( 'general' )->func( 'breadcrumb' ) );
add_action( 'learn-press/before-main-content' , 'lp_archive_courses_open' , 10 );
if ( !function_exists( 'lp_archive_courses_open' ) ) {
    function lp_archive_courses_open() {
    	$courses_page_id = learn_press_get_page_id('courses');
		$courses_page_url = $courses_page_id ? get_page_link($courses_page_id): learn_press_get_current_url();
		if ( is_post_type_archive( LP_COURSE_CPT ) || is_page( learn_press_get_page_id( 'courses' ) ) ) {
			?>
				<div id="lp-archive-courses" class="lp-archive-courses" data-all-courses-url="<?php echo esc_url($courses_page_url) ?>">
			<?php
		}elseif ( is_singular( LP_COURSE_CPT ) ) {
			?>
				<div id="lp-single-course" class="lp-single-course lp-4">

			<?php
		}
    }
}


/** BEGIN: Checkout page */
remove_action('learn-press/after-checkout-form',LearnPress::instance()->template( 'checkout' )->func( 'account_logged_in' ),20);
remove_action( 'learn-press/after-checkout-form', LearnPress::instance()->template( 'checkout' )->func( 'order_comment' ), 60 );
add_action('learn-press/before-checkout-form',LearnPress::instance()->template( 'checkout' )->func( 'account_logged_in' ),9);
add_action('learn-press/before-checkout-form',LearnPress::instance()->template( 'checkout' )->func( 'order_comment' ),11);

// Remove header profile
//remove_action( 'learn-press/before-user-profile', LearnPress::instance()->template( 'profile' )->func( 'header' ), 10 );

// remove and add action single course
remove_all_actions( 'learn-press/course-content-summary');



add_action( 'learn-press/course-content-summary', 'thim_landing_tabs', 22 );
if ( ! function_exists( 'thim_landing_tabs' ) ) {
	function thim_landing_tabs() {
		learn_press_get_template( 'single-course/tabs/tabs-landing.php' );
	}
}
$layouts = get_theme_mod( 'learnpress_single_course_style', 1 );
if($layouts == '1'){
	add_action( 'learn-press/course-content-summary',LearnPress::instance()->template( 'course' )->callback( 'single-course/progress.php' ), 55 );
}
// add_action( 'learnpress/single-course/section-header',LearnPress::instance()->template( 'course' )->callback( 'single-course/progress.php' ), 55 );
add_action( 'learn-press/course-content-summary', LearnPress::instance()->template( 'course' )->text('<div id="tab-overview"></div>'), 50);
add_action( 'learn-press/course-content-summary',LearnPress::instance()->template( 'course' )->callback( 'single-course/tabs/overview.php' ), 51 );

add_action( 'learn-press/course-content-summary',LearnPress::instance()->template( 'course' )->func( 'course_curriculum' ), 60 );
add_action( 'learn-press/course-content-summary', LearnPress::instance()->template( 'course' )->func( 'course_extra_boxes' ), 62 );

add_action( 'learn-press/course-content-summary', 'thim_landing_faqs', 63 );
if ( ! function_exists( 'thim_landing_faqs' ) ) {
    function thim_landing_faqs() {

        $course = LP_Course::get_course( get_the_ID() );

		if ( ! $faqs = $course->get_faqs() ) {
			return;
		}

		?>
      
		</div>
		<?php

    }
}

add_action( 'learn-press/course-content-summary',LearnPress::instance()->template( 'course' )->callback( 'single-course/tabs/instructor.php' ), 65 );
function thim_course_students_list() {
    $course = learn_press_get_course();
    learn_press_get_template( 'students-list.php', array( 'course' => $course ), learn_press_template_path() . '/addons/students-list/' );
}
if ( class_exists( 'LP_Addon_Students_List' ) ) {
	add_action( 'learn-press/course-content-summary', 'thim_course_students_list', 74 );
}
if ( class_exists( 'LP_Addon_Course_Review' ) ) {
    add_action( 'learn-press/course-content-summary', 'thim_course_rate', 75 );
}

add_action( 'learn-press/course-content-summary', 'thim_related_courses', 80 );

add_action( 'theme_course_extra_boxes', LearnPress::instance()->template( 'course' )->func( 'course_extra_boxes' ), 5);


/*
 * Landing course navigation tab
 * */
 if ( ! function_exists( 'learn_press_landing_course_price' ) ) {
	/*
	 * Output course tabs
	 */

	function learn_press_landing_course_price() {
		learn_press_get_template( 'single-course/price.php' );
	}
}
add_action( 'thim_lp_landing_course_tab', 'learn_press_landing_course_price', 10 );
add_action( 'thim_lp_landing_course_tab', 'learn_press_course_button', 15 );

// Add action in learning Page
add_action( 'learn-press/content-learning', LearnPress::instance()->template( 'course' )->callback( 'single-course/tabs/tabs' ), 10 );
// add_action( 'learn-press/content-learning', 'learn_press_course_tabs', 35 );
if ( ! function_exists( 'learn_press_course_tabs' ) ) {
	/*
	 * Output course tabs
	 */

	function learn_press_course_tabs() {
		learn_press_get_template( 'single-course/tabs/tabs.php' );
	}
}

add_action( 'thim_learning_after_tabs_wrapper', 'learn_press_course_remaining_times', 10 );
if ( ! function_exists( 'learn_press_course_remaining_times' ) ) {

	function learn_press_course_remaining_times() {

		if ( ! $course = learn_press_get_course() ) {
			return;
		}

		if ( ! $user = learn_press_get_current_user() ) {
			return;
		}

		if ( false === ( $remain =  thim_timestamp_remaining_duration($course)) ) {
			return;
		}

		if ( $user->has_finished_course( $course->get_id() ) ) {
			return;
		}
		learn_press_get_template( 'single-course/remaining-time.php', array( 'remaining_time' => $remain ) );
	}
}
/**
 * custom remaning by UTC
 *
 * @param Remaining time
 */
function thim_timestamp_remaining_duration( LP_Course $course ) {

	$timestamp_remaining = - 1;
	$user                = learn_press_get_user( get_current_user_id() );

	if ( 0 === absint( $course->get_data( 'duration' ) ) ) {
		return $timestamp_remaining;
	}

	if ( $user instanceof LP_User_Guest ) {
		return $timestamp_remaining;
	}

	$course_item_data = $user->get_course_data( $course->get_id() );

	if ( ! $course_item_data ) {
		return $timestamp_remaining;
	}

	$course_start_time   = $course_item_data->get_start_time()->get_raw_date();
	$duration            = $course->get_data( 'duration' );
	$timestamp_expire    = strtotime( $course_start_time . ' +' . $duration );
	$timestamp_current   = strtotime( current_time( 'mysql' ) );
	$timestamp_remaining = $timestamp_expire - $timestamp_current;

	if ( $timestamp_remaining < 0 ) {
		$timestamp_remaining = 0;
	}

	$diff = learn_press_seconds_to_weeks( $timestamp_remaining );

	return $diff;
}
/*
 * Before Curiculumn on item page
 */
if ( ! function_exists( 'thim_before_curiculumn_item_func' ) ) {
	function thim_before_curiculumn_item_func() {
		$args = array();
		$args = wp_parse_args( $args, apply_filters( 'learn_press_breadcrumb_defaults', array(
			'delimiter'   => ' <span class="delimiter">/</span> ',
			'wrap_before' => '<nav class="thim-font-heading learn-press-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
		) ) );

		$breadcrumbs = new LP_Breadcrumb();


		$args['breadcrumb'] = $breadcrumbs->generate();

		learn_press_get_template( 'global/breadcrumb.php', $args );
	}
}
add_action( 'thim_before_curiculumn_item', 'thim_before_curiculumn_item_func' );

// Add media for only Lesson

if ( ! function_exists( 'thim_content_item_lesson_media' ) ) {
	function thim_content_item_lesson_media() {
        $item          = LP_Global::course_item();
        $user          = learn_press_get_current_user();
        $course_item   = LP_Global::course_item();
        $course        = learn_press_get_course();
 		$can_view_content_course = $user->can_view_content_course( $course->get_id() );
		$is_no_required_enroll = $course->is_no_required_enroll();
		$can_view_item         = $user->can_view_item( $course_item->get_id(), $can_view_content_course );

        $media_intro   = get_post_meta( $item->get_id(), '_lp_lesson_video_intro', true );

        if ( ! empty( $media_intro )  && $can_view_item->flag || $is_no_required_enroll ) {
            ?>
            <div class="learn-press-video-intro thim-lesson-media">
                <div class="wrapper">
                    <?php echo $media_intro; ?>
                </div>
            </div>
            <?php
        }

	}
}
add_action( 'learn-press/before-course-item-content', 'thim_content_item_lesson_media', 5 );

// add edit link in content course item
if ( ! function_exists( 'thim_content_item_edit_link' ) ) {
	function thim_content_item_edit_link() {
		$course      = learn_press_get_course();
		if ( ! $course ) {
			return;
		}
		$course_item = LP_Global::course_item();
		$user        = learn_press_get_current_user();
		if ( $user->can_edit_item( $course_item->get_id(), $course->get_id() ) ): ?>
            <p class="edit-course-item-link">
                <a href="<?php echo get_edit_post_link( $course_item->get_id() ); ?>">
               		 <i class="fa fa-pencil-square-o"></i> <?php esc_html_e( 'Edit item', 'course-builder' ); ?>
                </a>
            </p>
		<?php endif;
	}
}
add_action( 'learn-press/after-course-item-content', 'thim_content_item_edit_link', 3 );

// filter course loop
add_filter( 'learn_press_course_loop_begin','learn_press_courses_loop_begin');
add_filter( 'learn_press_course_loop_end', 'learn_press_courses_loop_end');

if(! function_exists('learn_press_courses_loop_begin')){
	function learn_press_courses_loop_begin(){
		return '<div class=" learn-press-courses row ">';
	}
}
if(! function_exists('learn_press_courses_loop_end')){
	function learn_press_courses_loop_end(){
		return '</div>';
	}
}
// add class fix style use don't description in page profile
add_filter('learn-press/profile/class','thim_class_has_description_user');
function thim_class_has_description_user($classes){
	$profile = LP_Profile::instance();
	$user    = $profile->get_user();
  	if (  ! isset( $user ) ) {
		return;
	}
	$bio = $user->get_description();
  	if ( !$bio ){
 		$classes[] ='no-bio-user';
  	}
 	return $classes;
}
// button redirect don't login in purchase
add_action('learn-press/after-purchase-button','redirect_login_button_purchase',5);
function redirect_login_button_purchase(){
	if ( ! isset( $course ) ) {
			$course = learn_press_get_course();
	}
	$checkout_redirect = add_query_arg( 'enroll-course', $course->get_id(), $course->get_permalink() );
	$login_redirect    = add_query_arg( 'redirect_to', $checkout_redirect, thim_get_login_page_url() );
	echo '<input type="hidden" name="redirect_to" value="'. esc_url( $login_redirect ).'">';
}


if ( ! function_exists( 'thim_lp_social_user' ) ) {
	function thim_lp_social_user($user_id = '') {
		global $post;
		if ( ! $user_id ) {
			$user = learn_press_get_user( $post->post_author );
 			$socials = $user->get_profile_socials( $user->get_id());
		}else{
			$user_instructor = learn_press_get_user($user_id );
			$socials = $user_instructor->get_profile_socials($user_id);
 		}
   		?>
		 <ul class="social-link">
			<?php foreach($socials as $value) : ?>
				<li><?php echo $value; ?></li>
			<?php endforeach;?>
		</ul>
		<?php
	}
}
