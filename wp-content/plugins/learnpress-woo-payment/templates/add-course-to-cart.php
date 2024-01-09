<?php
/**
 * Template for displaying add-to-cart button
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.3.1
 * @editor tungnx
 */

defined( 'ABSPATH' ) || exit();

if ( ! isset( $course ) ) {
	return;
}

$course_id        = $course->get_id();
$is_added_to_cart = $is_added_to_cart ?? false;
?>

<?php do_action( 'learn-press/before-add-course-to-cart-form' ); ?>

<div class="wrap-btn-add-course-to-cart">
	<?php if ( ! $is_added_to_cart ) : ?>
	<form name="form-add-course-to-cart" method="post">

		<?php do_action( 'learn-press/before-add-course-to-cart-button' ); ?>

		<input type="hidden" name="course-id" value="<?php echo esc_attr( $course->get_id() ); ?>"/>
		<input type="hidden" name="add-course-to-cart-nonce"
				value="<?php echo wp_create_nonce( 'add-course-to-cart' ); ?>"/>

		<button class="lp-button btn-add-course-to-cart">
			<?php _e( 'commencez maintenant', 'learnpress-woo-payment' ); ?>
		</button>

		<?php do_action( 'learn-press/after-add-course-to-cart-button' ); ?>

	</form>
	<?php else : ?>
		<?php LP_Addon_Woo_Payment_Preload::$addon->get_template( 'view-cart', compact( 'course', 'is_added_to_cart' ) ); ?>
	<?php endif; ?>
</div>

<?php do_action( 'learn-press/after-add-course-to-cart-form' ); ?>
