<?php
/**
 * Template for displaying curriculum tab of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/curriculum.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.1
 */

defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();
$user   = learn_press_get_current_user();

if ( ! $course || ! $user ) {
	return;
}
$can_view_content_course = $user->can_view_content_course( $course->get_id() );
$curriculum_heading = apply_filters( 'learn_press_curriculum_heading', esc_html__( 'Programme', 'course-builder' ) );
?>
<?php if ( ! learn_press_is_learning_course() ): ?>
	<!-- <div id="tab-curriculum" style="height: 68px;"></div> -->
<?php endif; ?>
<?php
	if(thim_is_learning()){
		do_action( 'thim_learning_after_tabs_wrapper' ); 
	}
 ?>
<div class="course-curriculum" id="learn-press-course-curriculum">
	<div class="curriculum-heading">
		<?php if ( $curriculum_heading ) { ?>
			<div class="title">
				<h2 class="course-curriculum-title"><?php echo( $curriculum_heading ); ?></h2>
			</div>
		<?php } ?>
		<div class="search">
			<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				<input type="text" class="search-field"
				       placeholder="<?php echo esc_attr__( 'Recherche...', 'course-builder' ) ?>"
				       value="<?php echo get_search_query() ?>" name="s" />
				<input type="hidden" name="post_type" value="lp_lession">
				<button type="submit" class="search-submit"><span class="ion-android-search"></span></button>
			</form>
		</div>
		<!-- Display total learning in landing course page -->
		<div class="total">
			<?php
			$total_lessson = $course->count_items( 'lp_lesson' );
			$total_quiz    = $course->count_items( 'lp_quiz' );

			if ( $total_lessson || $total_quiz ) {
				
				echo '<span class="total-lessons">' . esc_html__( 'Total learning: ', 'course-builder' );
				if ( $total_lessson ) {
					echo '<span class="text">' . sprintf( _n( '%d lesson', '%d lessons', $total_lessson, 'course-builder' ), $total_lessson ) . '</span>';
				}

				if ( $total_quiz ) {
					echo '<span class="text">' . sprintf( _n( ' / %d quiz', ' / %d quizzes', $total_quiz, 'course-builder' ), $total_quiz ) . '</span>';
				}
				echo '</span>';
			}
			?>
			<!-- End -->

			<!-- Display total course time in landing course page -->
			<?php
			$course_duration_text = thim_duration_time_calculator( $course->get_id(), 'lp_course' );
			$course_duration_meta = get_post_meta( $course->get_id(), '_lp_duration', true );
			$course_duration      = explode( ' ', $course_duration_meta );

			if ( ! empty( $course_duration[0] ) && $course_duration[0] != '0' ) {
				?>
				<span class="total-time"><?php esc_html_e( 'Time: ', 'course-builder' ); ?>
					<span class="text"><?php echo( $course_duration_text ); ?></span></span>
				<?php
			}
			?>
			<!-- End -->
		</div>
	</div>
	
	<!-- Display Breadcrumb in sidebar course item popup -->
	<?php do_action( 'thim_before_curiculumn_item' ); ?>
	<?php learn_press_get_template( 'single-course/progress.php' ); ?>
	<!-- End -->

    <div class="curriculum-scrollable">

		<?php
		/**
		 * @deprecated
		 */
		do_action( 'learn_press_before_single_course_curriculum' );

		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/before-single-course-curriculum' );
		?>

		<?php
		$curriculum  = $course->get_curriculum();
		$user_course = $user->get_course_data( get_the_ID() );
		$user        = learn_press_get_current_user();
		if ( $curriculum ) :
			?>
			<ul class="curriculum-sections">
				<?php
				foreach ( $curriculum as $section ) {
					$args = [
						'section'                 => $section,
						'can_view_content_course' => $can_view_content_course,
						'user_course'             => $user_course,
						'user'                    => $user,
					];

					learn_press_get_template( 'single-course/loop-section.php', $args );
				}
				?>
			</ul>

		<?php else : ?>
			<p class="curriculum-empty">
			<?php
			echo wp_kses_post(
				apply_filters(
					'learnpress/course/curriculum/empty',
					esc_html__( 'Curriculum is empty', 'learnpress' )
				)
			);
			?>
			</p>
		<?php endif ?>

		<?php
		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/after-single-course-curriculum' );

		/**
		 * @deprecated
		 */
		do_action( 'learn_press_after_single_course_curriculum' );
		?>

    </div>

</div>

