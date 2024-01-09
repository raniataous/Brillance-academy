<?php
/**
 * Template for displaying instructor tab in single course page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/co-instructor/single-course-tab.php.
 *
 * @author  ThimPress
 * @package LearnPress/Co-Instructor/Templates
 * @version 3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( $instructors ) {
	foreach ( $instructors as $instructor_id ) {
		$instructor_profile_link = learn_press_user_profile_link( $instructor_id );

		$instructor = get_userdata( $instructor_id ); // WP_User|false

		if ( ! $instructor ) {
			return;
		}

		$instructor_meta = get_user_meta( $instructor_id );
		$instructor_meta = array_map( 'thim_get_user_meta', $instructor_meta );
		?>

		<div class="thim-course-co-instructor teacher">
			<div class="author-avatar">
				<?php echo get_avatar( $instructor_id, 150 ); ?>
				<?php thim_lp_social_user($instructor_id) ?>
 			</div>

			<div class="author-bio">
				<div class="name">
					<?php echo '<a href="' . esc_url( $instructor_profile_link ) . '">' . esc_html( $instructor->display_name ) . '</a>'; ?>
				</div>

				<?php if ( ! empty( $instructor_meta['lp_info_major'] ) ): ?>
					<div class="major"><?php echo esc_html( $instructor_meta['lp_info_major'] ) ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $instructor_meta['description'] ) ): ?>
					<p class="description"><?php echo( $instructor_meta['description'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<?php
	}
}
