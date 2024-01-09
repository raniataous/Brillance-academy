<?php
/**
 * Template for displaying infobar of landing course.
 *
 * @author  ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php
$course_info_button = get_post_meta( get_the_ID(), 'thim_course_info_button', true );
$course_includes    = get_post_meta( get_the_ID(), 'thim_course_includes', true );
$thim_cms_show_price = true;
if ( class_exists( 'LP_Addon_Coming_Soon_Courses' ) ) {
	$instance_addon = LP_Addon_Coming_Soon_Courses::instance();
	if ( $instance_addon->is_coming_soon( get_the_ID() ) && 'no' == get_post_meta( get_the_ID(), '_lp_coming_soon_metadata', true ) ) {
		$thim_cms_show_price = false;
	}
}
?>

<div class="info-bar">

	<?php if ( function_exists( 'lp_course_price' ) && $thim_cms_show_price) { ?>   
        <div class="price-box"><?php LearnPress::instance()->template( 'course' )->course_pricing();?></div>
	<?php } ?>  

    <div class="inner-content">
        <div class="button-box">
			<?php learn_press_course_button(); ?>
			<?php if ( ! empty( $course_info_button ) ) { ?>
                <p class="intro"><?php echo ent2ncr( $course_info_button ); ?></p>
			<?php } ?>
        </div>
		<?php
		learn_press_get_template( 'single-course/progress.php' );
		 if ( ! empty( $course_includes ) ) { ?>
            <div class="includes-box">
				<?php echo ent2ncr( $course_includes ); ?>
            </div>
		<?php } ?>

		<?php thim_social_share( 'learnpress_single_' ); ?>
    </div>

</div>