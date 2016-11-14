<?php 
$meta = get_user_meta($profile_author->ID);
preg_match('/"(.+)"/', $meta['edfg_capabilities'][0], $role );
?>

<div id="main" class="large-12 columns user-profile">

<div class='large-6 push-1 columns user-profile-section'>
	<div class="row profile">

		<div class="fr-img large-3 small-3 small-centered large-uncentered columns">
			<?php the_hrb_user_gravatar( $profile_author->ID, 190 ); ?>
			
		</div>

		<div class="large-9 columns user-info">

			<h2 class="user-name"><?php the_hrb_user_display_name( $profile_author->ID ); ?></h2>

			<span class="user-actions" id="profile-edit-action">
				<?php the_hrb_user_actions( $profile_author->ID ); ?>
			</span>
			<?php if ( get_the_hrb_user_location( $profile_author->ID ) ): ?>
					<div>
					<span id ='profile-location' data-tooltip title="<?php echo esc_attr( __( 'User Location', APP_TD ) ); ?>" class="location"><i class="icon i-user-location"></i><?php the_hrb_user_location( $profile_author->ID ); ?></span>
					</div>
			<?php endif; ?>

			<!-- freelancer meta above desc-->
			<div class="freelancer-meta cf">
				<div class="review-meta">
				<?php the_hrb_user_rating( $profile_author->ID, __( 'No ratings yet', APP_TD ) ); ?>
			</div>
				<div class="freelancer-success"><?php the_hrb_user_success_rate( $profile_author ); ?></div>
				<div class="freelancer-portfolio">
				<?php if ( ! empty( $profile_author->user_url ) ):  ?>
						<a data-tooltip title="<?php echo esc_attr( __( 'Website', APP_TD ) ); ?>" href="<?php echo esc_url( $profile_author->user_url ); ?>"><i class="icon i-website"></i></a>
				<?php endif; ?>
					<?php foreach( get_the_hrb_user_social_networks( $profile_author ) as $network_id => $value ): ?>
						<a class="profile-social-icons" data-tooltip target="_blank" title="<?php echo esc_attr( APP_Social_Networks::get_title( $network_id) ); ?>" href="<?php echo esc_url( APP_Social_Networks::get_url( $network_id, $value ) ); ?>"><i class="icon fi-social-<?php echo esc_attr( $network_id ); ?>"></i></a>
				<?php endforeach; ?>
				</div>
			</div>


		</div> 

		<div class="large-12 columns user-bio">

		<div class="user-header-meta row" id='meta-stats'>
			 <div class="meta-rating large-4 columns large-uncentered success-rate">
				<i class="icon i-success-rate"></i><small class="label-meta"><?php echo __( 'Success Rate:', APP_TD ); ?></small> <strong><?php the_hrb_user_success_rate( $profile_author ); ?></strong>
			</div>
			<div class="meta-current large-4 columns large-uncentered active-projects">
				<i class="icon i-active-projects"></i><small class="label-meta"><?php echo __( 'Active Projects:', APP_TD ); ?></small> <strong><?php the_hrb_user_related_active_projects_count( $profile_author ); ?></strong>
			</div>
			<div class="meta-completed large-4 columns large-uncentered completed-projects">
				<i class="icon i-completed-projects"></i><small class="label-meta"><?php echo __( 'Projects Completed:', APP_TD ); ?></small> <strong><?php the_hrb_user_completed_projects_count( $profile_author ); ?></strong>
			</div>
		</div><!-- end row -->

		

			<div class="user-description"><?php the_hrb_user_bio( $profile_author ); ?></div>

			


	  </div>

	</div><!-- end row -->

	<div class="row">
		<div class="large-12 columns skills">
			<div data-tooltip title="<?php echo esc_attr( __( 'The user skills', APP_TD ) ); ?>" class="user-skills profile"><?php the_hrb_user_skills( $profile_author, ' ', '<span class="label profile">', '</span>' ); ?></div>
		</div><!-- end 12-columns -->
	</div><!-- end row -->

	<?php if($role[1] == 'employer_freelancer' || $role[1] == 'freelancer'){ ?>
	<div class="row" id="profile-exp">
		<ul class="no-bullet profile-exp-tabs">
				<li class="user-profile-tabs" id="award-tab"><a id="profile-exp-award">Awards</a></li>
				<li class="user-profile-tabs" id="cert-tab"><a id="profile-exp-cert">Certificates</a></li>
				<li class="user-profile-tabs" id="member-tab"><a id="profile-exp-org">Organizations</a></li>
			</ul>

		<div class="large-12 columns experience" id="profile-experience-cert-div" style="display: none;">
			<?php				  
				if($meta['cert_name1']){
					output_sidebar_meta_certs(1, $meta); 
				}
				if($meta['cert_name2']){
					echo "<hr class='bio-hr' />";
					output_sidebar_meta_certs(2, $meta); 
				}
				if($meta['cert_name3']){
					echo "<hr class='bio-hr' />";
					output_sidebar_meta_certs(3, $meta); 
				}
			?>
		</div>
		<div class="large-12 columns experience" id="profile-experience-award-div">
			<?php
			if($meta['awards_name1']){
				output_sidebar_meta_awards(1, $meta);
			}
			if($meta['awards_name2']){
				output_sidebar_meta_awards(2, $meta);
			}
			if($meta['awards_name3']){
				output_sidebar_meta_awards(3, $meta);
			}


			?>
		</div><!--/awards-->

		<div class="large-12 columns experience" id="profile-experience-org-div">
			<?php
			if($meta['org_location1']){
				output_sidebar_meta_orgs(1, $meta);
			}
			if($meta['org_location2']){
				output_sidebar_meta_orgs(2, $meta);
			}
			if($meta['org_location3']){
				output_sidebar_meta_orgs(3, $meta);
			}
			?>
		</div><!--orgs-->
	</div>
	<?php } ?>



	<div class="user-content-tabs row">
	  <div class="section-container auto section-tabs" data-section>

		<!-- dynamic content within tabs -->

		<?php if ( $projects_owned && $projects_owned->have_posts() ): ?>

			<section class="services-current <?php echo empty( $active ) ? $active = 'active' : ''; ?>">

				<p class="title" data-section-title><a href="#projects-employer"><?php echo __( 'Owned Projects', APP_TD ) ?></a></p>

				<div class="content" data-section-content>

					<?php appthemes_load_template( 'profile-section-projects.php', array( 'projects' => $projects_owned, 'relation' => 'employer', ) ); ?>

				</div>

			</section>

		<?php endif; ?>



		<section class="services-current <?php echo empty( $active ) ? $active = 'active' : ''; ?>">

			<p class="title" data-section-title><a id="profile-reviews" href="#reviews"><?php echo __( 'Reviews', APP_TD ); ?></a></p>

			<div class="content" data-section-content>

				<?php appthemes_load_template( 'profile-section-reviews.php', array( 'reviews' => $reviews ) ); ?>

			</div>

		</section>

		<?php if ( $user_posts->have_posts() ) : ?>

				<section class="services-current <?php echo empty( $active ) ? $active = 'active' : ''; ?>">

					<p class="title" data-section-title><a href="#posts"><?php echo __( 'Posts', APP_TD ); ?></a></p>

					<div class="content" data-section-content>

						<?php appthemes_load_template( 'profile-section-posts.php', array( 'user_posts' => $user_posts ) ); ?>

					</div>

				</section>

		<?php endif; ?>

				<?php if ( $projects_participant && $projects_participant->have_posts() ) : ?>

				<section class="services-current <?php echo empty( $active ) ? $active = 'active' : ''; ?>">

					<p class="title" data-section-title><a href="#projects-worker" id="profile-projects"><?php echo __( 'Awarded Projects', APP_TD ) ?></a></p>

					<div class="content" data-section-content>

						<?php appthemes_load_template( 'profile-section-projects.php', array( 'projects' => $projects_participant, 'relation' => 'worker' ) ); ?>

					</div>

				</section>

		<?php endif; ?>

		<?php do_action( 'hrb_profile_tabs', $profile_author, $active ); ?>

	  </div>
	</div><!-- end row -->
</div>
	
<div class="large-4 columns pull-1 user-profile-section">
	<?php include('freelancer-profile-sidebar.php') ?>
</div>

</div><!-- end main -->






	

</div><!-- end #sidebar -->


<script type="text/javascript">


	function tabbedContentActive(thisObj){
		jQuery(thisObj).css('background-color', '#f25926');
		jQuery(thisObj).children().css('color', 'white');
	}

	function tabbedContentNotActive(thisObj){
		jQuery(thisObj).css('background-color', 'white');
		jQuery(thisObj).children().css('color', '#f25926');
	}

	jQuery(document).ready(function() {

		jQuery('#profile-experience-org-div').hide();
		jQuery('#profile-experience-cert-div').hide();

		tabbedContentActive( jQuery('#edu-tab') );

		jQuery('#work-tab').click(function() {
			tabbedContentActive( jQuery(this) );
			jQuery('#profile-experience-work-div').show();

			tabbedContentNotActive( jQuery('#edu-tab') );
			tabbedContentNotActive( jQuery('#cert-tab') );

			jQuery('#profile-experience-edu-div').hide();
			jQuery('#profile-experience-cert-div').hide();
		});

		jQuery('#edu-tab').click(function() {
			tabbedContentActive( jQuery(this) );
			jQuery('#profile-experience-edu-div').show();


			tabbedContentNotActive( jQuery('#work-tab') );
			tabbedContentNotActive( jQuery('#cert-tab') );
			jQuery('#profile-experience-work-div').hide();
			jQuery('#profile-experience-cert-div').hide();
		});



		jQuery('#cert-tab').click(function() {
			tabbedContentActive( jQuery(this) );
			jQuery('#profile-experience-cert-div').show();

			tabbedContentNotActive( jQuery('#award-tab') );
			tabbedContentNotActive( jQuery('#member-tab') );
			jQuery('#profile-experience-org-div').hide();
			jQuery('#profile-experience-award-div').hide();

		});

    	jQuery('#certifications').hide();
    	jQuery('#organizations').hide();


		tabbedContentActive( jQuery('#award-tab') );

    	jQuery('#award-tab').click( function() {
			tabbedContentActive( jQuery(this) );
    		jQuery('#profile-experience-org-div').hide();
			jQuery('#profile-experience-cert-div').hide();
			tabbedContentNotActive( jQuery('#member-tab') );
			tabbedContentNotActive( jQuery('#cert-tab') );
    		jQuery('#profile-experience-award-div').show();
    	});


    	jQuery('#member-tab').click( function() {
			tabbedContentActive( jQuery(this) );
    		jQuery('#profile-experience-award-div').hide();
			jQuery('#profile-experience-cert-div').hide();
			tabbedContentNotActive( jQuery('#award-tab') );
    		jQuery('#profile-experience-org-div').show();
			tabbedContentNotActive( jQuery('#cert-tab') );
    	});
	});


</script>