<?php
/**
 * Template for displaying recover order in user profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/orders/recover-order.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

defined( 'ABSPATH' ) || exit();
?>

<div class="profile-recover-order">
	<p class="recover-order__title"><?php esc_html_e( 'Si vous disposez dune clé de commande valide, vous pouvez la récupérer ici.', 'learnpress' ); ?></p>
	<p class="recover-order__description"><?php esc_html_e( 'Lorsque vous passez à la caisse en tant qu invité, une clé de commande sera envoyée à votre adresse e-mail. Vous pouvez utiliser la clé de commande pour créer une commande.', 'learnpress' ); ?></p>

	<?php learn_press_get_template( 'order/recover-form.php' ); ?>
</div>

