
<li>
<article id="project-<?php the_ID(); ?>" <?php ( is_hrb_project_featured() ? post_class( 'project featured' ) : post_class('project') ); ?>>

	<?php appthemes_before_post_title( HRB_PROJECTS_PTYPE ); ?>

	

	<?php appthemes_after_post_title( HRB_PROJECTS_PTYPE ); ?>

	<!-- project meta above desc-->
	<div class="project-meta cf">
		<div class="budget-deadline">
			<div class="project-budget-wrapper">
				<div class="project-budget">
					<span class="smally"><?php the_hrb_project_budget_type(); ?></span>
					<span class="budget"><?php the_hrb_project_budgets(); ?> </span>
				
					<span class="budget-type">
					
					<?php if ( '' !== $remain_days ): ?>
				<div class="project-expiress-wrapper <?php echo ( $remain_days < 0 ? 'project-expired' : '' ); ?>">
					<?php the_hrb_project_remain_days(); ?>
				</div>
			<?php endif; ?>
					
					</span>
				</div>
			</div>

			<?php $remain_days = get_the_hrb_project_remain_days(); ?>

			
		</div>

		
			
				
			
	</div>

	
<h2 class="archive-project-title"><?php the_hrb_project_title(); ?>	</h2>


</article>
</li>