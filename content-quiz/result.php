<?php
/**
 * Template for displaying quiz result.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-quiz/result.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user      = LP_Global::user();
$quiz      = LP_Global::course_item_quiz();
$quiz_data = $user->get_quiz_data( $quiz->get_id() );
$result    = $quiz_data->get_results( false );

if ( $quiz_data->is_review_questions() ) {
	return;
} ?>

<div class="quiz-result <?php echo esc_attr( $result['grade'] ); ?>">

    <h3><?php esc_html__( 'Your Result', 'kipso' ); ?></h3>

    <div class="result-grade">
        <span class="result-achieved"><?php echo esc_html($quiz_data->get_percent_result()); ?></span>
        <span class="result-require"><?php echo esc_html($quiz->get_passing_grade()); ?></span>
        <p class="result-message"><?php echo sprintf( esc_html__( 'Your grade is <strong>%s</strong>', 'kipso' ), $result['grade'] == '' ? esc_html__( 'Ungraded', 'kipso' ) : $result['grade_text'] ); ?> </p>
    </div>

    <ul class="result-statistic">
        <li class="result-statistic-field">
            <label><?php echo esc_html__( 'Time spend', 'kipso' ); ?></label>
            <p><?php echo esc_html($result['time_spend']); ?></p>
        </li>
        <li class="result-statistic-field">
            <label><?php echo esc_html__( 'Point', 'kipso' ); ?></label>
            <p><?php echo esc_html($result['user_mark'] . ' / ' . $result['mark']); ?></p>
        </li>
        <li class="result-statistic-field">
            <label><?php echo esc_html__( 'Questions', 'kipso' ); ?></label>
            <p><?php echo esc_html($quiz->count_questions()); ?></p>
        </li>
        <li class="result-statistic-field">
            <label><?php echo esc_html__( 'Correct', 'kipso' ); ?></label>
            <p><?php echo esc_html($result['question_correct']); ?></p>
        </li>
        <li class="result-statistic-field">
            <label><?php echo esc_html__( 'Wrong', 'kipso' ); ?></label>
            <p><?php echo esc_html($result['question_wrong']); ?></p>
        </li>
        <li class="result-statistic-field">
            <label><?php echo esc_html__( 'Skipped', 'kipso' ); ?></label>
            <p><?php echo esc_html($result['question_empty']); ?></p>
        </li>
    </ul>

</div>