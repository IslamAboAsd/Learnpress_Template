<?php 
/**
 * Template for displaying lesson item content in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/content-item-lp_lesson.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */
$course_id       = get_the_ID();
$course_rate_res = learn_press_get_course_rate( $course_id, false );
$course_rate     = $course_rate_res['rated'];
$total           = $course_rate_res['total'];
$students = get_post_meta( get_the_ID(), '_lp_students', true );
$max_students = get_post_meta( get_the_ID(), '_lp_max_students', true );
$course_includes = get_post_meta( get_the_ID(), '_course_includes', false );
   $item_classes = 'all ';
   $post_category = ''; $separator = ' '; $output = '';
   $item_cats = get_the_terms( get_the_ID(), 'course_category' );
   if(!empty($item_cats) && !is_wp_error($item_cats)){
      foreach((array)$item_cats as $item_cat){
         $item_classes .= $item_cat->slug . ' ';
         $cat_color = get_term_meta( $item_cat->term_id, 'course_category_color', true );
         $output .= '<a class="cat-course-link '.$cat_color.'" href="'.get_category_link( $item_cat->term_id ).'" title="' . esc_attr( sprintf( esc_attr__( "View all posts in %s", 'learnpress' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
      }
      $post_category = trim($output, $separator);
   }

   $thumbnail = 'post-thumbnail';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }

 

   if(!isset($layout)){
      $layout = 'carousel';
   }
   if($layout == 'grid'){
      $item_classes .= ' item-columns';
   }
   $course = LP_Global::course();
   $duration = get_post_meta( get_the_ID(), '_lp_duration', true );
   $lesson_count = $course->count_items( LP_LESSON_CPT );
?>

<div class="<?php echo esc_attr($item_classes) ?>">
   <article id="course-2-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('course-block'); ?>>
      <div class="course-thumbnail">
         <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
       
      </div>  
	  
		<span class="rating-box">
			
				<?php
				
				if ( isset( $course_rate_res['items'] ) && !empty( $course_rate_res['items'] ) ):
					foreach ( $course_rate_res['items'] as $item ):
						$percent = round( $item['percent'], 0 );
					
					endforeach;
			
				endif;
				if($total >0){ ?>
				<span>
			[ هناك <?php echo($total); ?> تعليقات الطلاب ]
				</span>
				<?php
			 }else{ ?>
				<span>
			[ لايوجد تعليقات  ]
				</span>	
			<?php	}
				?>
		</span>
	
	<?php
	learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );
	?>
	

      <div class="entry-content">
         <div class="content-top">
            <div class="course-price">
               <?php if ( ! $price = $course->get_price_html() ) {
                  echo esc_html('Free', 'learnpress');
               }else{ ?>
                  <?php if ( $course->has_sale_price() ) { ?>
<!--                     <span class="origin-price"> <?php // echo wp_kses($course->get_origin_price_html(), true); ?></span> -->
                  <?php } ?>
			  <span class="price"><?php echo wp_kses($price, true); ?></span>

               <?php } ?>   
            </div>
					
            <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h2>
            
				<?php if( isset($course_includes[0]) && $course_includes[0] ){ ?>
					<div class="course-includes">
					
						<ul>
						<?php foreach ($course_includes[0] as $item) { ?>
							<li><?php echo wp_kses( $item, true ) ?></li>
						<?php } ?>
						</ul>
					</div>
				<?php } ?>	

          

         </div>
		  <div class="cours-footer">
			  
		
         <div class="right-footer">
			   <div class="course-author">
               <div class="author-picture">
				   <p><?php echo esc_html__( 'المدرب', 'tootaya' ) ?>&nbsp;</p>
                  <?php echo wp_kses($course->get_instructor()->get_profile_picture('thumbnail'), true); ?> 
				   <?php echo wp_kses($course->get_instructor_html(), true); ?>
               </div>
             
            </div>
    
         </div>
        <div class="left-footer">
						<p class="label"><?php echo esc_html__( 'المسجلين', 'tootaya' ) ?></p>
						<span class="value"><?php echo esc_html($students); ?></span>
						<span class="icon students"><i class="fas fa-user-friends"></i></span>

					</div>
			    </div>
      </div>
   </article>   
</div>

