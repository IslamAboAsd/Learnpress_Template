<?php
/**
 * Template for displaying students of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/students.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();
$max_students = get_post_meta( get_the_ID(), '_lp_max_students', true );

// Do not show if course is no require enrollment
if ( ! $course || ! $course->is_required_enroll() ) {
	return;
}
?>

<span class="course-students" title="<?php echo esc_attr( $course->get_students_html() ); ?>">

   <i class="icon fas fa-user-check"></i>
   <?php $count = intval($course->count_students());
   echo sprintf( esc_html__('%d  students', 'kipso' ), $count) ?>

</span>
