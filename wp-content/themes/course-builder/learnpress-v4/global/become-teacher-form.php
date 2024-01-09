<?php
/**
 * Template for displaying the form let user fill out their information to become a teacher.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/become-teacher-form.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.1.5.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$user = learn_press_get_current_user( false );
?>

<div id="learn-press-become-teacher-form" class="become-teacher-form learn-press-form">

    <div class="title">
        <h4 class="title-form">
            <?php echo esc_html__( 'Start the change', 'course-builder' ) ?>
        </h4>
        <h3 class="register">
            <?php echo esc_html__( 'Register to become an Instructor', 'course-builder' ) ?>
        </h3>
    </div>
    <form name="become-teacher-form" method="post" enctype="multipart/form-data" action="">
		<?php if ( ! empty( $description ) ) : ?>
			<p class="become-teacher-form__description"><?php echo wp_kses_post( $description ); ?></p>
		<?php endif ?>
        <?php if ( ! $user || $user instanceof LP_User_Guest ) { ?>
            <p class="message message-info"><?php printf( __( 'You have to <a class="login" href="%s">login</a> to fill out this form', 'course-builder' ), add_query_arg( 'redirect_to', get_permalink(), thim_get_login_page_url() ) ); ?></p>
        <?php } ?>
		<ul class="become-teacher-fields form-fields">
			<?php do_action( 'learnpress/become-a-teacher/before-form' ); ?>

				<li class="form-field">
					<label for="bat_name"><?php esc_html_e( 'Name', 'learnpress' ); ?></label>
					<input type="text" name="bat_name" required placeholder="<?php esc_attr_e( 'Your name', 'learnpress' ); ?>" value="<?php echo isset( $_POST['bat_name'] ) ? wp_unslash( $_POST['bat_name'] ) : $user->get_display_name(); ?>">
				</li>
				<li class="form-field">
					<label for="bat_email"><?php esc_html_e( 'Email', 'learnpress' ); ?></label>
					<input type="email" name="bat_email" required placeholder="<?php esc_attr_e( 'Your email address', 'learnpress' ); ?>" value="<?php echo isset( $_POST['bat_email'] ) ? wp_unslash( $_POST['bat_email'] ) : $user->get_email(); ?>">
				</li>
				<li class="form-field">
					<label for="bat_phone"><?php esc_html_e( 'Phone', 'learnpress' ); ?></label>
					<input type="text" name="bat_phone" placeholder="<?php esc_attr_e( 'Your phone number', 'learnpress' ); ?>" value="<?php echo isset( $_POST['bat_phone'] ) ? wp_unslash( $_POST['bat_phone'] ) : ''; ?>">
				</li>
				<li class="form-field">
					<label for="bat_message"><?php esc_html_e( 'Message', 'learnpress' ); ?></label>
					<textarea name="bat_message" placeholder="<?php esc_attr_e( 'Your message', 'learnpress' ); ?>"><?php echo isset( $_POST['bat_message'] ) ? wp_unslash( $_POST['bat_message'] ) : ''; ?></textarea>
				</li>

			<?php do_action( 'learnpress/become-a-teacher/after-form' ); ?>

		</ul>

		<input type="hidden" name="request-become-a-teacher-nonce" value="<?php echo wp_create_nonce( 'request-become-a-teacher' ); ?>">

		<button type="submit" data-text="<?php echo ! empty( $submit_button_process_text ) ? esc_attr( $submit_button_process_text ) : esc_attr__( 'Submitting', 'learnpress' ); ?>">
			<?php echo ! empty( $submit_button_text ) ? esc_html( $submit_button_text ) : esc_html__( 'Submit', 'learnpress' ); ?>
		</button>
	</form>

</div>
