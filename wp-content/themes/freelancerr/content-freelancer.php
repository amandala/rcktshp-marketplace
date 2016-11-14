<article id="freelancer-<?php echo $user->ID; ?>" <?php hrb_user_class( HRB_FREELANCER_UTYPE, $user ); ?>>
	<div class="row">

		<div class="fr-img large-3 small-3 small-centered large-uncentered columns">
			<?php the_hrb_user_gravatar( $user, 175 ); ?>
			
		</div>

		<div class="large-9 columns">
			<h2 class="freelancer-header">
				<?php the_hrb_user_display_name( $user ); ?>
				<?php if ( $user->hrb_location ): ?>
					<span class="freelancer-loc"><i class="icon i-user-location"></i><?php the_hrb_user_location( $user ); ?></span>
				<?php endif; ?>
			</h2>

			<!-- freelancer meta above desc-->
			<div class="freelancer-meta cf">
				<div class="review-meta"><?php the_hrb_user_rating( $user, __( 'No ratings yet', APP_TD ) ); ?></div>
				<div class="freelancer-success"><?php the_hrb_user_success_rate( $user ); ?></div>
				<div class="freelancer-portfolio freelist" >
					<?php if ( $user->user_url ): ?>
						<?php if(is_user_logged_in()): ?>
						<?php the_hrb_user_portfolio( $user ); ?></a>
					<?php else:{ $login = wp_login_url( $redirect ); echo '<a href="$login">log in to view portfolio</a>' ; } ?>
					<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>

			<!-- freelancer desc-->
			<!-- MODIFIED  only display the first 150 characters of the user's description. If the user is not logged in, redirect them to the login page and make them login before they can view the rest.-->
			<div class="freelancer-description">
				<?php $bio = get_the_hrb_user_bio( $user ); 
				//$bio = strip_tags($bio);

				if(strlen($bio) > 100){ 
					$first = substr($bio, 0, 100); 
					//$first = strip_tags($first);

					echo '<div class="user-desc-half">' . $first ;
					if(! is_user_logged_in()){ 
						$login = wp_login_url( $redirect ); 
						echo '<a href="$login"> ...log in to view more</a></div>' ; }
						else{ 
							echo '<a class="link-show-more" > ...view more</a></div>'; }

					if( is_user_logged_in()){
						echo '<div class="user-desc-full" style="display: none;" id="id-'.$user->ID.'">'. $bio . '</div>';
						echo '<a class="link-show-less" name="'.$user->ID.'" style="display:none;">view less</a>';
					}
				} 
				else{
					echo $bio;
				}					
				?>
				<script type="text/javascript">

			
				jQuery(function(){
					jQuery('.show-less').hide();

					jQuery('.link-show-more').on('click',function(){
						jQuery(this).parent().parent().hide();
    					jQuery(this).parent('p').parent('div').next('.user-desc-full').show();
    					jQuery(this).parent('p').parent('div').next('.user-desc-full').next('a').show();				
					});	

					jQuery('.link-show-less').on('click',function(){
						jQuery(this).prev('div.user-desc-full').hide();
						jQuery(this).prev('div.user-desc-full').prev('div.user-desc-half').show();
    					jQuery(this).hide();
    				
					});	
				}) 
				

				</script>
			</div>

		</div><!-- end 9-columns -->

	</div><!-- end row -->

	<div class="row">
		<div class="large-12 columns">
			<div class="user-skills"><?php the_hrb_user_skills( $user, ' ', '<span class="label">', '</span>' ); ?></div>
		</div><!-- end 12-columns -->
	</div><!-- end row -->
</article>