<?php
if ( ! function_exists( 'thim_get_all_plugins_require' ) ) {
	function thim_get_all_plugins_require( $plugins ) {
		$plugins = array(
			array(
				'name'     => 'LearnPress',
				'slug'     => 'learnpress',
				'required' => true,
			),
			array(
				'name'     => 'Thim Course Builder',
				'slug'     => 'thim-course-builder',
				'premium'  => true,
				'required' => true,
			),

			array(
				'name'       => 'Widget Logic',
				'slug'       => 'widget-logic',
				'premium'    => false,
				'no-install' => true,
				'required'   => true,
			),

			array(
				'name'     => 'Certificates Add-On for LearnPress',
				'slug'     => 'learnpress-certificates',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-certificates.png',
				'add-on'   => true,
			),
			array(
				'name'     => 'Collections Add-On for LearnPress',
				'slug'     => 'learnpress-collections',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-collections.png',
				'add-on'   => true,
			),
			array(
				'name'     => 'Paid Memberships Pro Add-On for LearnPress',
				'slug'     => 'learnpress-paid-membership-pro',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-paid-membership.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'Co-Instructors Add-On for LearnPress',
				'slug'     => 'learnpress-co-instructor',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-co-instructor.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'LearnPress – Course Review',
				'slug'     => 'learnpress-course-review',
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'     => 'WooCommerce Add-On for LearnPress',
				'slug'     => 'learnpress-woo-payment',
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-woocommerce.png',
				'premium'  => true,
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'     => 'Authorize.Net Add-On for LearnPress',
				'slug'     => 'learnpress-authorizenet-payment',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-authorizenet.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'Coming Soon Add-On for LearnPress',
				'slug'     => 'learnpress-coming-soon-courses',
				'premium'  => true,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-coming-soon.png',
				'required' => false,
				'add-on'   => true,
			),

			array(
				'name'     => 'Commission Add-On for LearnPress',
				'slug'     => 'learnpress-commission',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-commission.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'Content Drip Add-On for LearnPress',
				'slug'     => 'learnpress-content-drip',
				'premium'  => true,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-content-drip.png',
				'required' => false,
				'add-on'   => true,
			),

			array(
				'name'     => 'Gradebook Add-On for LearnPress',
				'slug'     => 'learnpress-gradebook',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-gradebook.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'myCRED Add-On for LearnPress',
				'slug'     => 'learnpress-mycred',
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-mycred.png',
				'premium'  => true,
				'required' => false,
				'add-on'   => true,
			),

			array(
				'name'     => 'Random Quiz Add-On for LearnPress',
				'slug'     => 'learnpress-random-quiz',
				'premium'  => true,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-random-quiz.png',
				'required' => false,
				'add-on'   => true,
			),

			array(
				'name'     => 'Stripe Add-On for LearnPress',
				'slug'     => 'learnpress-stripe',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-stripe.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'Sorting Choice Add-On for LearnPress',
				'slug'     => 'learnpress-sorting-choice',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-sorting-choice.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'Student List Add-On for LearnPress',
				'slug'     => 'learnpress-students-list',
				'premium'  => true,
				'required' => false,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-students-list.png',
				'add-on'   => true,
			),

			array(
				'name'     => 'LearnPress – Course Wishlist',
				'slug'     => 'learnpress-wishlist',
				'required' => false,
				'add-on'   => true,
			),

			array(
				'name'     => 'LearnPress – bbPress Integration',
				'slug'     => 'learnpress-bbpress',
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'     => 'LearnPress – BuddyPress Integration',
				'slug'     => 'learnpress-buddypress',
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'     => '2Checkout Add-On for LearnPress',
				'slug'     => 'learnpress-2checkout-payment',
				'premium'  => true,
				'icon'     => 'https://plugins.thimpress.com/downloads/images/lp-2checkout.png',
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'     => 'LearnPress – Prerequisites Courses',
				'slug'     => 'learnpress-prerequisites-courses',
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'     => 'LearnPress – Export Import',
				'slug'     => 'learnpress-import-export',
				'required' => false,
				'add-on'   => true,
			),
			array(
				'name'        => 'WP Events Manager - WooCommerce Payment ',
				'slug'        => 'wp-events-manager-woo-payment',
				'premium'     => true,
				'required'    => false,
				'icon'        => 'https://ps.w.org/wp-events-manager-woocommerce-payment-methods-integration/assets/icon-128x128.png',
				//				'version'     => '2.2',
				'description' => 'Support paying for a booking with the payment methods provided by Woocommerce',
				'add-on'      => true,
			),
			array(
				'name'       => 'WPBakery Visual Composer',
				'slug'       => 'js_composer',
				'premium'    => true,
				'no-install' => true,
				'icon'       => 'https://s3.envato.com/files/260579516/wpb-logo.png',
				'required'   => false,
			),
			array(
				'name'        => 'Elementor Page Builder',
				'slug'        => 'elementor',
				'required'    => false,
				'no-install'  => true,
				'description' => 'The most advanced frontend drag & drop page builder. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.',
			),
			array(
				'name'       => 'Thim Elementor Kit',
				'slug'       => 'thim-elementor-kit',
				// 'premium'     => true,
				'no-install' => true,
				'required'   => false,
			),
			//			array(
			//				'name'        => 'Anywhere Elementor',
			//				'slug'        => 'anywhere-elementor',
			//				'required'    => false,
			//				'no-install'  => true,
			//				'description' => 'Allows you to insert elementor pages and library templates anywhere using shortcodes.',
			//				'add-on'      => true,
			//			),
			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => 'WP Events Manager',
				'slug'     => 'wp-events-manager',
				'required' => false,
			),
			array(
				'name'       => 'Paid Memberships Pro',
				'slug'       => 'paid-memberships-pro',
				'required'   => false,
				'no-install' => true,
			),
			array(
				'name'       => 'WordPress Social Login',
				'slug'       => 'wordpress-social-login',
				'required'   => false,
				'no-install' => true,
			),
			array(
				'name'       => 'HubSpot – CRM, Email Marketing, Live Chat, Forms & Analytics',
				'slug'       => 'leadin',
				'required'   => false,
				'no-install' => true,
			),
			array(
				'name'       => 'MailChimp for WordPress',
				'slug'       => 'mailchimp-for-wp',
				'required'   => false,
				'no-install' => true,
			),

			array(
				'name'        => 'bbPress',
				'slug'        => 'bbpress',
				'required'    => false,
				'no-install'  => true,
				'description' => 'bbPress is forum software with a twist from the creators of WordPress. By The bbPress Community.',
			),

			array(
				'name'        => 'Thim Portfolio',
				'slug'        => 'tp-portfolio',
				'premium'     => true,
				'no-install'  => true,
				'required'    => false,
				'icon'        => 'https://plugins.thimpress.com/downloads/images/thim-portfolio.png',
				'version'     => '1.6',
				'description' => 'A plugin that allows you to show off your portfolio. By ThimPress.',
			),

			array(
				'name'       => 'Slider Revolution',
				'slug'       => 'revslider',
				'premium'    => true,
				'icon'       => 'https://plugins.thimpress.com/downloads/images/revslider.png',
				'no-install' => true,
				//				'version' => '6.1.0',
			),
		);

		return $plugins;
	}
}

add_filter( 'thim_core_get_all_plugins_require', 'thim_get_all_plugins_require' );


function thim_envato_item_id() {
	return '20370918';
}

add_filter( 'thim_envato_item_id', 'thim_envato_item_id' );

//add_filter( 'thim_core_plugin_icon_install', 'thim_custom_plugin_icon', 10, 2 );
//if ( ! function_exists( 'thim_custom_plugin_icon' ) ) {
//	function thim_custom_plugin_icon( $icon, $plugin ) {
//		if ( $plugin->get_slug() == 'anywhere-elementor' ) {
//			$icon = 'https://ps.w.org/' . $plugin->get_slug() . '/assets/icon-128x128.jpg';
//		}
//
//		return $icon;
//	}
//}
