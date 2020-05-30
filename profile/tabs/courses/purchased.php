<?php
/**
 * Template for displaying purchased courses in courses tab of user profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/courses/purchased.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.11.2
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile       = learn_press_get_profile();
$filter_status = LP_Request::get_string( 'filter-status' );
$query         = $profile->query_courses( 'purchased', array( 'status' => $filter_status ) );
?>

<div class="learn-press-subtab-content">

    <h3 class="profile-heading"><?php esc_html__( 'Purchased Courses', 'kipso' ); ?></h3>

	<?php if ( $filters = $profile->get_purchased_courses_filters( $filter_status ) ) { ?>
        <ul class="lp-sub-menu">
			<?php foreach ( $filters as $class => $link ) { ?>
                <li class="<?php echo esc_attr($class); ?>"><?php echo wp_kses($link, true); ?></li>
			<?php } ?>
        </ul>
	<?php } ?>

	<?php if ( $query['items'] ) { ?>
        <table class="lp-list-table profile-list-courses profile-list-table">
            <thead>
            <tr>
                <th class="column-course"><?php esc_html__( 'Course', 'kipso' ); ?></th>
                <th class="column-date"><?php esc_html__( 'Date', 'kipso' ); ?></th>
                <th class="column-passing-grade"><?php esc_html__( 'Passing Grade', 'kipso' ); ?></th>
                <th class="column-status"><?php esc_html__( 'Progress', 'kipso' ); ?></th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $query['items'] as $user_course ) { ?>
				<?php $course = learn_press_get_course( $user_course->get_id() ); ?>
                <tr>
                    <td class="column-course">
                        <a href="<?php echo esc_url($course->get_permalink()); ?>">
							<?php echo esc_html($course->get_title()); ?>
                        </a>
                    </td>
                    <td class="column-date"><?php echo esc_html($user_course->get_start_time( 'd M Y' )); ?></td>
                    <td class="column-passing-grade"><?php echo esc_html($course->get_passing_condition( true )); ?></td>
                    <td class="column-status">
						<?php if ( $user_course->get_results( 'status' ) !== 'purchased' ) { ?>
                            <span class="result-percent"><?php echo esc_html($user_course->get_percent_result()); ?></span>
                            <span class="lp-label label-<?php echo esc_attr( $user_course->get_results( 'status' ) ); ?>">
                                <?php echo esc_html($user_course->get_status_label( $user_course->get_results( 'status' ) )); ?>
                            </span>
						<?php } else { ?>
                            <span class="lp-label label-<?php echo esc_attr( $user_course->get_results( 'status' ) ); ?>">
                                <?php echo esc_html($user_course->get_status_label( $user_course->get_results( 'status' )) ); ?>
                            </span>
						<?php } ?>
                    </td>
                </tr>
			<?php } ?>
            </tbody>
            <tfoot>
            <tr class="list-table-nav">
                <td colspan="2" class="nav-text">
					<?php echo wp_kses($query->get_offset_text(), true); ?>
                </td>
                <td colspan="2" class="nav-pages">
					<?php $query->get_nav_numbers( true, $profile->get_current_url() ); ?>
                </td>
            </tr>
            </tfoot>
        </table>
	<?php } else {
		learn_press_display_message( esc_html__( 'No courses!', 'kipso' ) );
	} ?>
</div>
