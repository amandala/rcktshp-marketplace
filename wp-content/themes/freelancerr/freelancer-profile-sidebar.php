<?php

	$meta = get_user_meta($profile_author->ID);

?>

<div id="freelancer-profile-sidebar" class="large-12 columns">
	<div class="sidebar-widget-wrap cf">
		<div id="" class="widget large-12 columns widget_text">
			<div id="tabvanilla" class="widget">
	 
				<ul class="no-bullet profile-exp-tabs">
					<li id="edu-tab"><a id="profile-exp-education">Education</a></li>
					<li id="work-tab"><a id="profile-exp-work">Work Experience</a></li>
				</ul>


				<div class="large-12 columns experience" id="profile-experience-edu-div">
					<?php


					if($meta['edu_name']){
						?>
						<div class='large-12 columns' id='edu-name'>
							<h4 id='meta-institution'><span id='edu-icon'><?php $img = site_url("wp-content/themes/hirebee-child/images/education-icon.png");
								echo "<img alt='rocketship education' height='50px' width='50px' src='".$img."' ></span>";
								print_r($meta['edu_name'][0]); ?></h4>
						</div>
						<div class='large-12 columns' id='edu-degree'>
							<?php print_r($meta['edu_degree'][0]);  ?>
						</div>
						<div class='large-12 columns' id='edu-dates'>
							Start Date: <?php print_r($meta['edu_start'][0]);  ?>

							<?php
							echo '<br />';
							if($meta['edu_end']){
								echo 'End Date: ';
								print_r($meta['edu_end'][0]);

							}
							else{
								echo 'End Date: Undetermined ';
							}
							if($meta['edu_gpa']){
								echo '<br />';
								echo " GPA: ";
								if($meta['edu_gpa'][0] == 4){
									echo "4.0" ;
								}
								else{
									print_r($meta['edu_gpa'][0]);
								}
							}
							?>
						</div>
						<hr class="bio-hr" />
						<div class='row'>
							<?php if($meta['edu_details'][0]){
								echo "<div  class='large-12 columns' id='edu-desc'>";
								print_r($meta['edu_details'][0]);
								echo  "</div>";
							}
							?>
						</div>
						<?php
					}

					?>
				</div>

				<div class="large-12 columns experience" id="profile-experience-work-div" style="display: none;">
					<?php

					if($meta['we_location1']){
						display_work_experience(1, $meta);

						if($meta['we_location2']){
							echo "<hr class='bio-hr' />";
							display_work_experience(2, $meta);
						}

						if($meta['we_location3']){
							echo "<hr class='bio-hr' />";
							display_work_experience(3, $meta);
						}
					}
					?>
				</div>

				
			 
			</div><!--/widget-->
		</div>
	</div>
</div>

<div class="large-12 columns"id="sidebar-insatgram-feed">
	<div class="large-6 push-3 columns">
		<?php 
		if($meta['instagram']){
			$insta_user_name = ($meta['instagram'][0]);
			$insta_client_id = getClientId($insta_user_name);

			$feed = getInstaFeed($insta_client_id);
			?>
			<div id="slideshow">
			<?php
			foreach ($feed as $post) {
				$thumb = $post['images']['thumbnail']['url'];

				 if ($post === reset($feed)){
				 	echo "<img src='".$thumb."' class='active' style='position:absolute; >";
				 }
				 else{
					echo "<img src='".$thumb."' style='position:absolute;'>";
				 }
			}
			?>
			</div>
			<?php
		}
	 ?>	
	</div>

</div>


<style type="text/css">
    .active{
        z-index:99;
    }
</style>

<script>
 	jQuery(document).ready( function(){

	 	var $$ = jQuery;

	    function slideSwitch() {
	        var active = $$('div#slideshow IMG.active');
	        var next = active.next();

	        next.addClass('active');

	        active.removeClass('active');
	    }

	    $$(function() {
	        setInterval( "slideSwitch()", 5000 );
	    });

    });
</script>

