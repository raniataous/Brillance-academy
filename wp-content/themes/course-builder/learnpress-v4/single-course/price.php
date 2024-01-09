<?php
/**
 * Template for displaying price of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/price.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user   = learn_press_get_current_user();
$course = learn_press_get_course();
if ( ! $course || ! $user ) {
	return;
}
$is_buy_through_membership = false;
if ( class_exists( 'LP_Addon_PMPRO' ) ) {
	$is_buy_through_membership = LP_Settings::instance()->get( 'buy_through_membership' ) == 'yes' ? true : false;
}
$is_course_in_membership = (bool) get_post_meta( $course->get_id(), '_lp_pmpro_levels', false );

if ( $user->has_enrolled_course( $course->get_id() ) || ( $is_buy_through_membership && $is_course_in_membership ) ) {
	return;
}

if ( ! $price = $course->get_price_html() ) {
	return;
}

?>

<?php if ( $course->has_sale_price() ) { ?>

	<span class="course-origin-price"> <?php echo $course->get_origin_price_html(); ?></span>

<?php } ?>

<?php echo '<span class="course-price">' . $price . '</span>'; ?>

