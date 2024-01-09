<?php
/**
 * Template for displaying course info of single course.
 *
 * @author   ThimPress
 * @package  CourseBuilder/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course_id = get_the_ID();
$course    = learn_press_get_course( $course_id );
$author    = $course->get_author();
?>
<div class="course-info">
	<ul class="list-inline clearfix">
	
		<li class="list-inline-item item-categories">
			<label><?php esc_html_e( 'Categories', 'course-builder' ); ?></label>
			<?php learn_press_get_template( 'single-course/meta/category.php' ) ?>
		</li>
		
		<?php if ( function_exists( "learn_press_get_course_rate" ) ) : ?>
			<?php
			$total = $course_rate = 0;

			$course_rate_res = learn_press_get_course_rate( $course_id, false );
			$course_rate     = $course_rate_res['rated'];
			$total           = $course_rate_res['total'];
			?>
			<li class="list-inline-item item-review">
				<label><?php esc_html_e( 'Review', 'course-builder' ); ?></label>
				<?php
				// rating
				learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );
				if ( is_single() ) {
					$total = intval( $total );
					if ( $total > 0 ) {
						$text = sprintf( _n( '(%s Review)', '(%s Reviews)', $total, 'course-builder' ), $total );
					} else {
						$text = sprintf( '(%s Review)', $total );
					}
				} else {
					$text = sprintf( _n( '( %s Rating )', '( %s Rating )', $total, 'course-builder' ), $total );
				}
				echo ent2ncr( $text );
				?>
			</li>
		<?php endif; ?>

		<?php thim_course_forum_link(); ?>
	</ul>
</div>
