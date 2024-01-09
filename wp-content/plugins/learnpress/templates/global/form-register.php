<?php
/**
 * Template for displaying global login form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/form-register.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();
?>

<div id="register-form-container" class="learn-press-form-register learn-press-form"   style="margin-left:500px"  >

<div class="auth-page-img" style="position: absolute; width: 100%;
    max-height: 100px;
    object-fit: cover;
 
    margin-top: 20px;
   left:-150px;
    top: 0;">
<figure class="wp-block-image size-full"><img src="http://localhost/brillance-academy/wp-content/uploads/2023/07/Capturesssssss2-removebg-preview.png"  alt="" class="wp-image-12415"/></figure></div>
<br/><br/><br/><div class="auth-page-img" style="position: absolute; width: 100%;
    max-height: 100px;
    object-fit: cover;
 
    margin-top: 450px;
   left:-150px;
    top: 0;">
<figure class="wp-block-image size-full"><img  src="http://localhost/brillance-academy/wp-content/uploads/2023/07/Capturessssss1-removebg-preview.png" alt="" class="wp-image-12415"/></figure></div>
	<h3 style="    font-weight: 700;
    font-size: 36px;
    text-align: center;
    color: #000;
    line-height: 67px;
    margin-top: -10px;
    font-family: Tajawal !important;

   
    ">
<?php echo esc_html_x( 'Créer un compte
', 'register-heading', 'learnpress' ); ?></h3>

	<?php do_action( 'learn-press/before-form-register' ); ?>

	<form name="learn-press-register" method="post" action="" >

		<ul class="form-fields">

			<?php do_action( 'learn-press/before-form-register-fields' ); ?>

			<li class="form-field">
				<label for="reg_email"><?php esc_html_e( 'Email', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_email" name="reg_email" type="text" placeholder="<?php esc_attr_e( 'Email', 'learnpress' ); ?>" autocomplete="email" value="<?php echo esc_attr( LP_Helper::sanitize_params_submitted( $_POST['reg_email'] ?? '' ) ); ?>">
			</li>
			<li class="form-field">
				<label for="reg_username"><?php esc_html_e( 'Username', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_username" name="reg_username" type="text" placeholder="<?php esc_attr_e( 'Username', 'learnpress' ); ?>" autocomplete="username" value="<?php echo esc_attr( LP_Helper::sanitize_params_submitted( $_POST['reg_username'] ?? '' ) ); ?>">
			</li>
			<li class="form-field">
				<label for="reg_password"><?php esc_html_e( 'Password', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_password" name="reg_password" type="password" placeholder="<?php esc_attr_e( 'Password', 'learnpress' ); ?>" autocomplete="new-password">
			</li>
			<li class="form-field">
				<label for="reg_password2"><?php esc_html_e( 'Confirm Password', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_password2" name="reg_password2" type="password" placeholder="<?php esc_attr_e( 'Password', 'learnpress' ); ?>" autocomplete="off">
</li>	
<li><?php
// Assuming LearnPress categories are hierarchical and have a taxonomy named 'course_category'

// Vérifier si l'utilisateur est connecté
$user_id = get_current_user_id();

// Récupérer les termes sélectionnés par l'utilisateur lors de l'inscription
$selected_categories = ($user_id) ? get_user_meta($user_id, 'course_category', true) : array();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_category'])) {
    // Sanitize the selected category value
    $selected_category = sanitize_text_field($_POST['course_category']);

    // Update user meta with the selected category
    update_user_meta($user_id, 'course_category', $selected_category);

    // Update the selected categories array for display purposes
    $selected_categories = array($selected_category);

    // Add the category page to the menu
    add_category_page_to_menu($selected_category);
}

$categories = get_terms(array(
    'taxonomy'   => 'course_category',
    'hide_empty' => false,
));

if (!empty($categories)) {
    echo '<label for="course_category" style="margin-left: 20px;
    font-weight: 400;
    user-select: none;
    font-family: Tajawal !important;
    font-weight: 500;
    font-size: 20px;
    line-height: 14px;
    color: #494949;
    display: flex;
	
    justify-content: start;
    align-items: flex-start;">Classe &nbsp;<span class="required">*</span></label><br/>';

    echo '<form method="post" action="">'; // Add a form tag

    echo '<select name="course_category" id="course_category" style="margin-left: -10px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    background: #fff;
    border: 1px solid #dadada;
    border-radius: 46px;
    font-size: 15px;
    line-height: 22px;
    width: 100%;
    padding: 0 26px 0 15px;" required>';

    echo '<option value="">choisissez Votre classe </option>'; // Optional, add a default option

    foreach ($categories as $category) {
        // Vérifier si la catégorie n'a pas de parent (est une catégorie principale)
        if ($category->parent == 0) {
            $selected = in_array($category->term_id, $selected_categories) ? 'selected="selected"' : '';

            echo '<option value="' . esc_attr($category->term_id) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
        }
    }

    echo '</select><br/><br/>';

    // Ajouter un champ caché pour stocker la valeur sélectionnée actuelle
    echo '<input type="hidden" name="selected_course_category" id="selected_course_category" value="' . esc_attr(implode(',', $selected_categories)) . '">';
  
}




?>


</li>



			<?php do_action( 'learn-press/after-form-register-fields' ); ?>
		</ul>

		<?php do_action( 'register_form' ); ?>

		<p>
			<?php wp_nonce_field( 'learn-press-register', 'learn-press-register-nonce' ); ?>
			<button type="submit" style="font-size:30px;"><?php esc_html_e( 'Créer un compte', 'learnpress' ); ?></button>
		</p>
        <span style="display: flex;
    justify-content: center;
    margin-top: 15px;
    font-family: Tajawal !important;
    align-self: center;
    font-weight: 400;
    font-size: 1.3rem;"> Avez vous déjà un compte ?  <a href="#" id="show-login-form" style="font-family:Tajawal !important;
    color: #0ECDCD;
    transition: .1s;
}"> Se Connetcer </a></span>
</p>
        </p>
	</form>

	<?php do_action( 'learn-press/after-form-register' ); ?>



</div>




<div id="login-form-container" class="learn-press-form-logi learn-press-form" style="display: none; margin-left:500px">
<div>
    <figure class="wp-block-image size-full" style="position: absolute; width: 100%;
    max-height: 80%;
    object-fit: cover;
   
    margin-top: 50px;
   left:-150px;
    bottom: 0px;
    top: 0;"><img src="http://localhost/brillance-academy/wp-content/uploads/2023/07/Capturettttttttttttttttttt-removebg-preview.png" alt="" class="wp-image-12417"/></figure>
</div>
	<h3 style="font-weight: 700;
    font-size: 36px;
    text-align: center;
    color: #000;
    line-height: 67px;
    margin-top: 1.5rem;
    font-family: Tajawal !important;"><?php echo esc_html_x( 'Se connecter', 'login-heading', 'learnpress' ); ?></h3>

	<?php do_action( 'learn-press/before-form-custom-login' ); ?>

    <form name="learn-press-custom-login" method="post" action="">

		<?php do_action( 'learn-press/before-form-login-fields' ); ?>

		<ul class="form-fields">
			<li class="form-field">
				<label for="username"><?php esc_html_e( 'Username or email', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" name="username" id="username" placeholder="<?php esc_attr_e( 'Email or username', 'learnpress' ); ?>" autocomplete="username" />
			</li>
			<li class="form-field">
				<label for="password"><?php esc_html_e( 'Password', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="password" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'learnpress' ); ?>" autocomplete="current-password" />
			</li>
		</ul>
        <p  style="font-family: Tajawal!important;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 17px;
    color: #000000;
    margin-left: 350px;
  
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
    display: flex;
    padding-top: 42px; margin-top:-50px;">
        <?php echo '<a class="lost-pass-link" href="' . thim_get_lost_password_url() . '" title="' . esc_attr__( 'Lost Password', 'course-builder' ) . '">' . esc_html__( 'Mot de passe oublié ?', 'course-builder' ) . '</a>'; ?>
		</p>
		<?php do_action( 'learn-press/after-form-login-fields' ); ?>
		

		<?php do_action( 'login_form' ); ?>

		<p>
            <input type="hidden" name="learn-press-custom-login-nonce" value="<?php echo wp_create_nonce( 'learn-press-custom-login' ); ?>">
            <button type="submit"><?php esc_html_e( 'Login', 'learnpress' ); ?></button>
        </p>
		
		<p>
        <p>
 <span style="display: flex;
    justify-content: center;
    margin-top: 15px;
    font-family: Tajawal !important;
    align-self: center;
    font-weight: 400;
    font-size: 1.3rem;">Vous n'avez pas de compte ?<a href="#" id="show-registration-form" style="font-family:Tajawal !important;
    color: #35bbe3;
    transition: .1s;
}">Créez un nouveau compte</a></span>
</p>
        </p>
	
	</form>

    <?php do_action( 'learn-press/after-form-custom-login' ); ?>

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Show login form and hide registration form
        $('#show-login-form').on('click', function (e) {
            e.preventDefault();
            $('#register-form-container').hide();
            $('#login-form-container').show();
        });
        
        // Show registration form and hide login form
        $('#show-registration-form').on('click', function (e) {
            e.preventDefault();
            $('#login-form-container').hide();
            $('#register-form-container').show();
        });

        // Show registration form and hide login form from the login form
        $('#show-registration-form-from-login').on('click', function (e) {
            e.preventDefault();
            $('#login-form-container').hide();
            $('#register-form-container').show();
        });
    });
</script>

