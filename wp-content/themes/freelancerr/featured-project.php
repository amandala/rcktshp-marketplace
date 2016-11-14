
<div  class="clear"></div>




 
    <div class="banner">
		<div class="prevo"></div>

        <div class="viewport">




<ul >
	<!-- projects -->

	<?php if ( $projects->have_posts() ) : ?>

		

		<?php appthemes_before_loop( HRB_PROJECTS_PTYPE ); ?>

		<?php while( $projects->have_posts() ) : $projects->the_post(); ?>
			<?php if ( is_hrb_project_featured( get_the_ID() ) ) : ?>

			<?php appthemes_before_post( HRB_PROJECTS_PTYPE ); ?>

			<?php get_template_part( content, featured ); ?>
			
			

			<?php appthemes_after_post( HRB_PROJECTS_PTYPE ); ?>

			
			<?php else: ?>
	<?php endif; ?>
		<?php endwhile; ?>

		<?php appthemes_after_loop( HRB_PROJECTS_PTYPE ); ?>

	<?php else : ?>

		

	<?php endif; ?>
</ul>



<?php wp_reset_postdata(); ?>
	
</div>
<div class="nexto"></div>
</div>


<div  class="clear"></div>