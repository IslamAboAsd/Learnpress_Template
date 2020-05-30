<?php
/**
 * Template for displaying search course form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/search-form.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php if ( ! ( learn_press_is_courses() || learn_press_is_search() ) ) {
	return;
} ?>
<div class="learn-press-search lg-block-grid-2 md-block-grid-2 sm-block-grid-2 xs-block-grid-2">
	<div style="text-align: left;">
		<div class="gridlist-toggle desktop-hide-down">
            <a href="/courses/?layout=grid" id="grid" class="" title="Grid View"><i class="ekommart-icon-th-large"></i></a>
            <a href="/courses/?layout=list" id="list" class="active" title="List View"><i class="ekommart-icon-th-list"></i></a>
        </div>
	</div>
	<div class="col-md-10">
		<form method="get" name="search-course" class="learn-press-search-course-form"
      action="<?php echo learn_press_get_page_link( 'courses' ); ?>">

    <input type="text" name="s" class="search-course-input" value="<?php echo esc_attr($s); ?>"
           placeholder="بحث فى الورش"/>
    <input type="hidden" name="ref" value="course"/>

    <button class="lp-button button search-course-button">بحث</button>
</form>
		
	</div>
</div>

