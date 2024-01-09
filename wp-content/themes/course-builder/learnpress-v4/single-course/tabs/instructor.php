<?php
/**
 * Template for displaying the instructor of a course
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course = learn_press_get_course();
$author = $course->get_instructor();
if ( ! $author ) {
	return;
}
$author_meta = get_user_meta( $author->get_id() );
$author_meta = array_map( 'thim_get_user_meta', $author_meta );
?>
<?php if ( ! learn_press_is_learning_course() ): ?>
	<!-- <div id="tab-instructor" style="height: 40px"></div> -->
<?php endif; ?>



	<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

</div>

