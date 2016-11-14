<?php
/*
Template Name: Full width template
*/
?>


<div id="main" class="large-12 columns">
	<div id="main-wrapper">

		<?php appthemes_before_page_loop(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php appthemes_before_page(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<section class="overview">

					<?php appthemes_before_page_content(); ?>

					<?php the_content(); ?>

					<?php appthemes_after_page_content(); ?>

				</section>

				<?php edit_post_link( __( 'Edit', APP_TD ), '<span class="edit-link">', '</span>' ); ?>

			</article>

			<?php appthemes_after_page(); ?>

		<?php endwhile; ?>

		<?php appthemes_after_page_loop(); ?>
	</div>

</div>
