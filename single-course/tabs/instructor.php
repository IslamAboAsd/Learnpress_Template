<?php
/**
 * Template for displaying instructor of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/instructor.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$course = LP_Global::course();
$profile = learn_press_get_profile();
$profile = learn_press_get_profile($course->get_instructor()->get_id());
$courses = $profile->query_courses( 'own' );

?>

<div class="course-author-tab-content">
	<?php do_action( 'learn-press/before-single-course-instructor' ); ?>

   <div class="author-info clearfix">
      <div class="author-picture">
         <?php echo wp_kses($course->get_instructor()->get_profile_picture(), true); ?>
      </div>
      <div class="author-name">
         <span><?php echo esc_html__( 'by', 'kipso' ) ?>&nbsp;</span><?php echo wp_kses($course->get_instructor_html(), true); ?>
         <div class="course-total"><?php echo esc_html($courses['total']) ?> <?php echo esc_html__( 'Courses', 'kipso' ) ?></div>
      </div>
   </div>
   <div class="author-bio">
		<?php echo wp_kses($course->get_author()->get_description(), true); ?>
   </div>
	<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

</div>