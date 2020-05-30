<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

$course = LP_Global::course();
$duration = get_post_meta( get_the_ID(), '_lp_duration', true );
$lesson_count = $course->count_items( LP_LESSON_CPT );
$thumbnail = 'full';
$categories_html = ''; $separator = ',';
$item_cats = get_the_terms( get_the_ID(), 'course_category' );
if(!empty($item_cats) && !is_wp_error($item_cats)){
   foreach((array)$item_cats as $item_cat){
      $cat_color = get_term_meta( $item_cat->term_id, 'course_category_color', true );
      $categories_html .= '<a class="cat-course-link '.$cat_color.'" href="'.get_category_link( $item_cat->term_id ).'" title="' . esc_attr( sprintf( esc_attr__( "View all posts in %s", 'kipso' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
   }
}
	$course_will_learn = get_post_meta( get_the_ID(), '_course_will_learn', false );
$duration = get_post_meta( get_the_ID(), '_lp_duration', true );
$max_students = get_post_meta( get_the_ID(), '_lp_max_students', true );
$students = get_post_meta( get_the_ID(), '_lp_students', true );
$lesson_count = $course->count_items( LP_LESSON_CPT );
$skill_level = get_post_meta( get_the_ID(), '_course_skill_level', true );
$certificate = get_post_meta( get_the_ID(), '_course_certificate', true );
$course_includes = get_post_meta( get_the_ID(), '_course_includes', false );

/**
 * @deprecated
 */
do_action( 'learn_press_before_main_content' );
do_action( 'learn_press_before_single_course' );
do_action( 'learn_press_before_single_course_summary' );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-main-content' );

do_action( 'learn-press/before-single-course' );

?>
<div id="learn-press-course" class="course-summary">
	<div class="course-single-page">
	<div class="single-course-content course-summary" id="learn-press-course" class="course-summary">
		<div class="row">
			
			
	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div class="single-course-aside">
				
		

			<?php if( isset($course_will_learn[0]) && $course_will_learn[0] ){ ?>
	
			<div class="sidebar-title">
				<?php echo esc_html__( "عن الورشة", 'tootaya' ); ?>
			</div>
			
			<?php foreach ($course_will_learn[0] as $item) { ?>
				<div class="meta-info">
				<?php echo wp_kses( $item, true ) ?>
				</div>
			<?php } ?>
		
		
	<?php } ?>
						  <div class="meta-info">
						<span class="label"><?php echo esc_html__( 'استيعاب الحضور', 'tootaya' ) ?></span>
						<strong ><?php echo esc_html($max_students); ?></strong>
							 </div>
                       <div class="meta-info">
						<span class="label"><?php echo esc_html__( 'المسجلين', 'tootaya' ) ?></span>
						<strong ><?php echo esc_html($students); ?></strong>
							 </div>
		
	<div class="course-cart">
					
					<?php learn_press_course_price() ?>
					<?php learn_press_course_buttons() ?>
				</div>
				
              </div>
			</div>
			
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="content-top">
			      

<!-- 		         <div class="course-category">
			         <?php// echo trim($categories_html, $separator); ?>
			      </div> -->

			      
			     
			   </div>

				<div class="post-thumbnail">
					<?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
				</div>			
			</div>
		</div>	
		
		
		<div class="entry-content ">
					<div class="content-inner">
						<?php
							//do_action( 'learn-press/single-course-summary' );
							$tab_version = get_post_meta( get_the_ID(), '_course_style', true );
							learn_press_get_template_part( 'single-course/tabs/tabs', $tab_version);
						?>
					</div>
				</div>
	</div>
</div>

</div>
<?php

/**
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

do_action( 'learn-press/after-single-course' );

/**
 * @deprecated
 */
do_action( 'learn_press_after_single_course_summary' );
do_action( 'learn_press_after_single_course' );
do_action( 'learn_press_after_main_content' );