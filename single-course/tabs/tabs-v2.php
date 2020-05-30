<?php
/**
 * Template for displaying tab nav of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/tabs.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php $tabs = learn_press_get_course_tabs(); ?>

<?php if ( empty( $tabs ) ) {
	return;
} ?>

<div id="onepage-course-tabs" class="course-tabs tabs-v2">

	<?php foreach ( $tabs as $key => $tab ) { ?>
      <div class="course-tab-panel" id="<?php echo esc_attr( $tab['id'] ); ?>">
			<?php
			if ( apply_filters( 'learn_press_allow_display_tab_section', true, $key, $tab ) ) {
				if ( is_callable( $tab['callback'] ) ) {
					call_user_func( $tab['callback'], $key, $tab );
				} else {
					do_action( 'learn-press/course-tab-content', $key, $tab );
				}
			}
			?>
      </div>
	<?php } ?>
      <div class="course-tab-panel margin-bottom-30" id="tab-overview">
         <?php if(class_exists('Gavias_Themer_Comment')){ ?>
            <div class="review-results">
               <?php 
                  $comment_results = Gavias_Themer_Comment::getInstance()->rating_results(get_the_ID());
               ?>
               
               <div class="all-review-progress">
                  
                  <div class="course-review-item clearfix">
                     <div class="review-info">
                        <div class="course__progress-label"><?php echo esc_html__( 'Excellent', 'kipso' ); ?></div>
                        <div class="count"><?php echo esc_attr( $comment_results['5_star'] ) ?></div>
                     </div>
                     <div class="course__progress">
                        <div class="course__progress-bar" data-progress-max="<?php echo ( ($comment_results['5_star'] / $comment_results['count']) * 100 ) ?>%">
                        </div>
                     </div>  
                  </div>

                  <div class="course-review-item clearfix">
                     <div class="review-info">
                        <div class="course__progress-label"><?php echo esc_html__( 'Very Good', 'kipso' ); ?></div>
                        <div class="count"><?php echo esc_attr( $comment_results['4_star'] ) ?></div>
                     </div>
                     <div class="course__progress">
                        <div class="course__progress-bar" data-progress-max="<?php echo ( ($comment_results['4_star'] / $comment_results['count']) * 100 ) ?>%">
                        </div>
                     </div>  
                  </div>

                  <div class="course-review-item clearfix">
                     <div class="review-info">
                        <div class="course__progress-label"><?php echo esc_html__( 'Average', 'kipso' ); ?></div>
                        <div class="count"><?php echo esc_attr( $comment_results['3_star'] ) ?></div>
                     </div>
                     <div class="course__progress">
                        <div class="course__progress-bar" data-progress-max="<?php echo ( ($comment_results['3_star'] / $comment_results['count']) * 100 ) ?>%">
                        </div>
                     </div>  
                  </div>

                  <div class="course-review-item clearfix">
                     <div class="review-info">
                        <div class="course__progress-label"><?php echo esc_html__( 'Poort', 'kipso' ); ?></div>
                        <div class="count"><?php echo esc_attr( $comment_results['2_star'] ) ?></div>
                     </div>
                     <div class="course__progress">
                        <div class="course__progress-bar" data-progress-max="<?php echo ( ($comment_results['2_star'] / $comment_results['count']) * 100 ) ?>%">
                        </div>
                     </div>  
                  </div>

                  <div class="course-review-item clearfix">
                     <div class="review-info">
                        <div class="course__progress-label"><?php echo esc_html__( 'Terrible', 'kipso' ); ?></div>
                        <div class="count"><?php echo esc_attr( $comment_results['1_star'] ) ?></div>
                     </div>
                     <div class="course__progress">
                        <div class="course__progress-bar" data-progress-max="<?php echo ( ($comment_results['1_star'] / $comment_results['count']) * 100 ) ?>%">
                        </div>
                     </div>  
                  </div>

               </div>

               
               <div class="course-reviews">
                  <div class="course-reviews-inner">
                     <?php 
                        $average_ratings = Gavias_Themer_Comment::getInstance()->get_average_ratings(get_the_id());
                     ?>
                     <span class="average"><?php echo number_format((float)$average_ratings['rate'], 1, '.', ''); ?></span>
                     <?php echo Gavias_Themer_Comment::getInstance()->rating_display($average_ratings['rate']) ?>
                     <span class="review-count"><?php echo esc_attr($average_ratings['count']); ?>&nbsp;<?php echo esc_html__( 'reviews', 'kipso' ); ?></span>
                  </div>   
               </div>
            </div>  
         <?php } ?>   

         <div class="course-review-2 clearfix">
            <?php 
               if( comments_open() || get_comments_number() ) {
                  comments_template();
               }
             ?>
         </div>
      </div>
</div>