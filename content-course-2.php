<?php 
   $item_classes = 'all ';
   $post_category = ''; $separator = ' '; $output = '';
   $item_cats = get_the_terms( get_the_ID(), 'course_category' );
   if(!empty($item_cats) && !is_wp_error($item_cats)){
      foreach((array)$item_cats as $item_cat){
         $item_classes .= $item_cat->slug . ' ';
         $cat_color = get_term_meta( $item_cat->term_id, 'course_category_color', true );
         $output .= '<a class="cat-course-link '.$cat_color.'" href="'.get_category_link( $item_cat->term_id ).'" title="' . esc_attr( sprintf( esc_attr__( "View all posts in %s", 'kipso' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
      }
      $post_category = trim($output, $separator);
   }

   $thumbnail = 'post-thumbnail';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }

   if(!isset($excerpt_words)){
      $excerpt_words = kipso_get_option('blog_excerpt_limit', 20);
   }

   if(!isset($layout)){
      $layout = 'carousel';
   }
   if($layout == 'grid'){
      $item_classes .= 'item-columns isotope-item';
   }
   $course = LP_Global::course();
  
   $duration = get_post_meta( get_the_ID(), '_lp_duration', true );
   $lesson_count = $course->count_items( LP_LESSON_CPT );
?>

<div class="<?php echo esc_attr($item_classes) ?>">
   <article id="course-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('course-block-2'); ?>>
      <div class="course-thumbnail">
         <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
         <div class="course-preview">
            <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php echo esc_html__('See Preview', 'kipso') ?></a>
         </div>
         <div class="course-category">
            <?php echo trim($output, $separator); ?>
         </div>
      </div>   

      <div class="entry-content">
         <div class="content-top">
            <div class="course-author">
               <div class="author-picture">
                  <?php echo wp_kses($course->get_instructor()->get_profile_picture(), true); ?>
               </div>
               <div class="author-name">
                  <span><?php echo esc_html__( 'by', 'kipso' ) ?>&nbsp;</span><?php echo wp_kses($course->get_instructor_html(), true); ?>
               </div>
            </div>

            <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h2>
            
             <?php if(class_exists('Gavias_Themer_Comment')){ ?>
               <?php $average_ratings = Gavias_Themer_Comment::getInstance()->get_average_ratings(get_the_id()); ?>
               <div class="course-reviews">
                  <?php echo Gavias_Themer_Comment::getInstance()->rating_display($average_ratings['rate']) ?>
                  <div class="average-ratings">
                     <span class="average"><?php echo esc_html($average_ratings['rate']); ?></span>
                     <span class="rate-count"><?php echo esc_html($average_ratings['count']); ?></span>
                  </div>
               </div>
            <?php } ?>   

         </div>
         <div class="content-bottom">
            <div class="course-duration">
               <i class="icon far fa-clock"></i><?php echo esc_html($duration); ?>
            </div>
            <div class="course-price">
               <?php if ( ! $price = $course->get_price_html() ) {
                  echo esc_html('Free', 'kipso');
               }else{ ?>
                  <span class="price"><?php echo wp_kses($price, true); ?></span>
                  <?php if ( $course->has_sale_price() ) { ?>
                    <span class="origin-price"> <?php echo wp_kses($course->get_origin_price_html(), true); ?></span>
                  <?php } ?>
               <?php } ?>   
            </div>
         </div>
      </div>
   </article>   
</div>

  