<?php
/**
 * Template for displaying progress of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();
$user   = learn_press_get_current_user();

if ( ! $course || ! $user ) {
	return;
}

// get course id
$course_id = $course->get_id();

if ( ! $user->has_enrolled_course( $course_id ) ) {
	return;
}

// user course data
$course_data = $user->get_course_data( $course_id );
if ( ! $course_data ) {
	return;
}

$course_results    = $course_data->get_result();
$passing_condition = $course->get_passing_condition();
$result            = round( $course_results['result'], 2 );
$grade             = $course_data->get_data()['graduation'];
$completed_items   = $course_results['completed_items'];
$course_items      = $course->count_items( '', true );
?>

<div class="learn-press-course-results-progress">

	<?php if ( get_theme_mod( 'thim_learnpress_lessons_completed', true ) ) { ?>
		<div class="items-progress">

		<?php
		$heading = apply_filters( 'learn-press/course/items-completed-heading', __( 'Items completed', 'course-builder' ) );
		if ( false !== $heading ) {
			?>
			<h4 class="lp-course-progress-heading">
				<?php echo esc_html( $heading ); ?>:  <span class="number"><?php printf( __( '%1$d of %2$d items', 'course-builder' ), $course_results['completed_items'], $course->count_items( '', true ) ); ?></span>
			</h4>
		<?php } ?>

		<div class="learn-press-progress lp-course-progress">
			<div class="progress-bg lp-progress-bar">
				<div class="progress-active lp-progress-value"
					style="left: <?php echo $course_results['count_items'] ? absint( $course_results['completed_items'] / $course_results['count_items'] * 100 ) : 0; ?>%;">
				</div>
			</div>
			<span class="ion-flag" style="left: <?php echo $course_results['count_items'] ? absint( $course_results['completed_items'] / $course_results['count_items'] * 100 ) : 0; ?>%;"></span>
		</div>

	</div>
	<?php } ?>

	<?php if ( get_theme_mod( 'thim_learnpress_course_results', true ) ) { ?>
		<div class="course-progress">
			<?php
			$heading = apply_filters( 'learn-press/course/result-heading', __( 'Course results', 'course-builder' ) );
			if ( false !== $heading ) {
				?>
				<h4 class="lp-course-progress-heading">
					<?php echo esc_html( $heading ); ?>:
					<div class="lp-course-status">
				<span class="number"><?php echo round( $course_results['result'], 2 ); ?><span
							class="percentage-sign">%</span></span>
						<?php if ( $grade ) { ?>
							<span class="lp-label grade <?php echo esc_attr( $grade ); ?>">
							<?php learn_press_course_grade_html( $grade ); ?>
					</span>
						<?php } ?>
					</div>
				</h4>
			<?php } ?>
			<div class="learn-press-progress lp-course-progress <?php echo $course_data->is_passed() ? ' passed' : ''; ?>"
					data-value="<?php echo $course_results['result']; ?>"
					data-passing-condition="<?php echo $passing_condition; ?>"
					title="<?php echo esc_attr( learn_press_translate_course_result_required( $course ) ); ?>">
					<div class="progress-bg lp-progress-bar">
						<div class="progress-active lp-progress-value" style="left: <?php echo $course_results['result']; ?>%;">
						</div>
					</div>
					<div class="lp-passing-conditional"
						data-content="<?php printf( esc_html__( 'Passing condition: %s%%', 'course-builder' ), $passing_condition ); ?>"
						style="left: <?php echo $passing_condition; ?>%;">
						<span class="ion-flag"></span>
					</div>
				</div>
		</div>
	<?php } ?>
</div>
