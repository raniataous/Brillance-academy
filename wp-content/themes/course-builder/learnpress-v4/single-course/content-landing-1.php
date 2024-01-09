<?php
/**
 * Template for displaying layout 1 content of landing course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( empty( get_theme_mod( 'learnpress_single_group_sharing' ) ) ) {
	$class = 'no-social';
} else {
	$class = 'has-social';
}
$thim_cms_show_metadata = $thim_cms_show_details = true;
if ( class_exists( 'LP_Addon_Coming_Soon_Courses' ) ) {
	$instance_addon = LP_Addon_Coming_Soon_Courses::instance();
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_metadata', true ) ) {
		$thim_cms_show_metadata = false;
	}
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_details', true ) ) {
		$thim_cms_show_details = false;
	}
}
?>

<div class="landing-1">
	
	<?php
	if ( $thim_cms_show_metadata ) {
		learn_press_get_template( 'single-course/course-info.php' );
	}
	?>

	<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>
	<?php
	do_action( 'learn-press/single-course-enroll-notice')
	?>
	<div class="course-landing-summary <?php echo esc_attr( $class ) ?>">

		<?php if ( ! empty( get_theme_mod( 'learnpress_single_group_sharing' ) ) ) { ?>
			<div class="share sticky-sidebar">
				<?php thim_social_share( 'learnpress_single_' ); ?>
			</div>
		<?php }; ?>

		<div class="content-landing-1">
			<?php
			if ( $thim_cms_show_details ) {
				do_action( 'learn-press/course-content-summary' );
			} else {
				do_action( 'learn-press-course-coming-soon-message' );
			} ?>
		</div>

	</div>

</div>


