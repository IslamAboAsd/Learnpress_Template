<?php
/**
 * Template for displaying Dashboard of user profile.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/dashboard.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$user = LP_Profile::instance()->get_user();

?>

<div class="learn-press-profile-dashboard">

	<?php
	/**
	 * Before dashboard
	 */
	do_action( 'learn-press/profile/before-dashboard' );

	/**
	 * Dashboard summary
	 */
	do_action( 'learn-press/profile/dashboard-summary' );

	/**
	 * After dashboard
	 */
	do_action( 'learn-press/profile/after-dashboard' );

	?>

	<div class="user-education">
		<h3 class="title"><?php echo esc_html__('Education', 'kipso') ?></h3>
		<div class="user-education-content">
        	<?php 
        		$team_educations = get_the_author_meta( 'team_educations', $user->get_id() );
			  	if ( ($team_educations) && count( $team_educations ) > 0 ) {
            	foreach( $team_educations as $education ) {
                	if ( isset( $education['title'] ) ) { 
         ?>
         	<div class="education-item">
         		<div class="education-title"><?php echo esc_html($education['title']) ?></div>
         		<div class="education-desc"><?php echo esc_html($education['desc']) ?></div>
         	</div>
         <?php          
                	}
            	}
        		}
        	?>
		</div>
	</div>

	<div class="user-experience">
		<h3 class="title"><?php echo esc_html__('Experience', 'kipso') ?></h3>
		<div class="user-experience-content">
        	<?php 
            $team_skills = get_the_author_meta( 'team_skills', $user->get_id() );
            if( is_array($team_skills) ){ 
      	?>
	         <div class="team-skills clearfix">
	           <?php foreach ($team_skills as $key => $skill) { ?>
	               <?php if(isset($skill['label']) && isset($skill['volume'])){ ?>
	                  <div class="team-progress-wrapper clearfix margin-bottom-20">
	                    <div class="team__progress-label"><?php echo esc_html( $skill['label'] ); ?></div>
	                    <div class="team__progress">
	                      <div class="team__progress-bar" data-progress-max="<?php echo esc_attr( $skill['volume'] ) ?>%">
	                        <span class="percentage"><?php echo esc_attr( $skill['volume'] ) ?>%</span>
	                      </div>
	                    </div>  
	                  </div> 
	               <?php } ?>   
	           <?php } ?>
	         </div>
     		<?php 
            }
     		?>
		</div>
	</div>

</div>