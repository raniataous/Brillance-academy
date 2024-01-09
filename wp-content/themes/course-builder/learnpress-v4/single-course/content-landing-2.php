<?php
/**
 * Template for displaying layout 2 content of landing course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$thim_show_metadata = $thim_cms_show_details = true;
if ( class_exists( 'LP_Addon_Coming_Soon_Courses' ) ) {
	$instance_addon = LP_Addon_Coming_Soon_Courses::instance();
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_metadata', true ) ) {
		$thim_show_metadata = false;
	}
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_details', true ) ) {
		$thim_cms_show_details = false;
	}
}
?>

<div class="landing-2">

	<div class="main-course">

		<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>
		<?php
		do_action( 'learn-press/single-course-enroll-notice')
		?>
		<?php
		if ( $thim_show_metadata ) {
			learn_press_get_template( 'single-course/course-info.php' );
		}
		?>

		<div class="course-landing-summary">

			<div class="content-landing-2">
				<?php
				if ( $thim_cms_show_details ) {
					do_action( 'learn-press/course-content-summary' );
				}else{
					do_action('learn-press-course-coming-soon-message');
				}
				?>
			</div>

		</div>

	</div>

	<div class="wrapper-info-bar sticky-sidebar">
		<?php learn_press_get_template( 'single-course/infobar.php' ); ?>
	</div>

</div>
