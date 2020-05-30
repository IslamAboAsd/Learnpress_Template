<?php
/**
 * Template for displaying introduction of quiz.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-quiz/intro.php.
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
$quiz   = LP_Global::course_item_quiz();
$count  = $quiz->get_retake_count();
?>

<ul class="quiz-intro">
    <li>
        <label><?php esc_html__( 'Attempts allowed', 'kipso' ); ?></label>
        <span><?php echo ( null == $count || 0 > $count ) ? esc_html__( 'Unlimited', 'kipso' ) : ( $count ? $count : esc_html__( 'No', 'kipso' ) ); ?></span>
    </li>
    <li>
        <label><?php esc_html__( 'Duration', 'kipso' ); ?></label>
        <span><?php echo esc_html($quiz->get_duration_html()); ?></span>
    </li>
    <li>
        <label><?php esc_html__( 'Passing grade', 'kipso' ); ?></label>
        <span><?php echo sprintf( '%d%%', $quiz->get_passing_grade() ); ?></span>
    </li>
    <li>
        <label><?php esc_html__( 'Questions', 'kipso' ); ?></label>
        <span><?php echo esc_html($quiz->count_questions()); ?></span>
    </li>
</ul>
