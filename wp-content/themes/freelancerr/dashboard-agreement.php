<div id="main-wrapper">
	<div class="large-10 push-1 columns">
	<div id="main" class="large-8 columns">

		<div class="dashboard dashboard-agreement">
		<div class="agreement">
			<?php if ( $proposal->selected ): ?>
				<h2><i class="icon i-agreement"></i><?php echo __( 'Agreement', APP_TD  ); ?></h2>
			<?php else: ?>
				<h2><i class="icon i-proposal-details"></i><?php echo __( 'Details', APP_TD  ); ?></h2>
			<?php endif; ?>

			<fieldset class="proposal">
				<div class="row">
					<div class="large-12 columns project-title-agreement">
						<legend class="project-title"><span><?php the_hrb_project_title(); ?></span></legend>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns proposal-meta">
						<fieldset class="large-4 columns budget">
							<span class="project-budget"><i class="icon i-budget"></i><small><?php echo __( 'Budget:', APP_TD  ); ?></small> <?php the_hrb_project_budget(); ?></span>
						</fieldset>
						<fieldset class="large-4 columns average">
							<span class="project-avg-bid"><i class="icon i-avg-proposals"></i><small><?php echo __( 'Avg. Proposals:', APP_TD  ); ?></small> <?php echo appthemes_display_price( appthemes_get_post_avg_bid( get_the_ID() ) ); ?></span>
						</fieldset>
						<fieldset class="large-4 columns total">
							<span class="project-total-bids"><i class="icon i-proposals-count"></i><small><?php echo __( 'Total Proposals:', APP_TD  ); ?></small> <?php echo appthemes_get_post_total_bids( get_the_ID() ); ?></span>
						</fieldset>
					</div>
				</div>
			</fieldset>


				<fieldset>
					<legend><?php _e( 'Freelancer', APP_TD ); ?></legend>
					<div class="row">
						<div class="large-12 columns">
							<div class="row">
								<div class="large-3 columns user-meta-info">
									<?php the_hrb_user_bulk_info( $proposal->user_id, array( 'show_gravatar' => array( 'size' => 65 ) ) ); ?>
								</div>
								<div class="large-9 columns">
								<legend><?php _e( 'Skills', APP_TD ); ?></legend>
									<div data-tooltip title="<?php echo esc_attr( __( 'The user skills', APP_TD ) ); ?>" class="proposal-user-skills user-skills"><?php the_hrb_user_skills( $proposal->user_id, ' ', '<span class="label">', '</span>' ); ?></div>
								</div>
							</div>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend><?php _e( 'Proposal', APP_TD ); ?></legend>
						<div class="row section-primary-info">
							<?php
							$posted_price = $post->_hrb_budget_price;
							$bid_ammount = $proposal->get_amount();


							if($posted_price < $bid_ammount) {
								$difference = $bid_ammount - $posted_price;
								echo "<div class='alert'>The freelancer increased the project price by $" . $difference . "</div>";
							}
							elseif($posted_price > $bid_ammount){
									$difference = $posted_price - $bid_ammount;
									echo "<div class='alert'>The freelancer decreased the project price by $" . $difference . "</div>";
							}
							?>
							<div class="large-4 small-6 columns proposal-amount">
								<span data-tooltip title="<?php echo __( 'Proposal Amount', APP_TD ); ?>"><i class="icon i-budget-alt"></i><?php the_hrb_proposal_amount( $proposal ); ?></span>
							</div>
							<div class="large-4 small-6 columns proposal-delivery-date">
								<span data-tooltip title="<?php echo __( 'Days for Delivery', APP_TD ); ?>"><i class="icon i-days-deliver"></i><?php echo $proposal->_hrb_delivery . ' ' . $proposal->label_delivery_unit; ?></span>
							</div>
							<div class="large-4 columns proposal-date">
								<span data-tooltip title="<?php echo __( 'Proposal Date', APP_TD ); ?>"><i class="icon i-proposal-date"></i><?php the_hrb_proposal_posted_time_ago( $proposal ); ?></span>
							</div>
						</div>
						<div class="large-9 columns dashboard-proposal-description">
								<span><?php echo sanitize_text_field( $proposal->comment_content ); ?></span>
						</div>

				</fieldset>


				<?php do_action( 'hrb_proposal_agreement_custom_fields', $proposal ) ; ?>

				<?php appthemes_load_template("form-proposal-agreement-{$user_relation}.php"); ?>

			</div>

		</div>

	</div><!-- #main -->

	<?php appthemes_load_template( 'sidebar-dashboard.php' ); ?>
	</div>
</div>