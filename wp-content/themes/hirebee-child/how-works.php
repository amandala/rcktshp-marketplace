<?php
/**
 * Template Name: How it Works
 */
?>
<div id="main" class="large-12 columns">

	<?php appthemes_before_page_loop(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php appthemes_before_page(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>

			<section class="overview">

				<div class="snip large-6 column">
					<h3>For Freelancers:</h3>
					<p>Become a freelancer and find dynamic job opportunities to gain career development experience. 
						Create a profile and apply for jobs and projects online to give you exposure in your field, 
						and begin working for businesses within minutes.</p>

	    			<p>What are the benefits?<p>
					<ul>
						<li>Earn paid work experience</li>
						<li>Establish your presence in your industry</li>
						<li>Build your professional portfolio before graduation</li>
					</ul>
				</div>

				<div class="snip large-6 column">
					<h3>For Employers:</h3>
					<p>Post company projects and find skilled freelance candidates momentarily. Eliminate the hassle 
						of outsourcing overseas, battling language barriers, and paying hefty prices for your online 
						projects - find qualified freelancers to complete your work instantly.</p>

	    			<p>What are the benefits?<p>
					<ul>
						<li>Find local talent without breaking the bank</li>
						<li>Project Manage resources, without language and time zone issues</li>
						<li>Hire skilled and affordable freelancers you can meet with in person</li>
					</ul>
				</div>
				<div class="questions large-12 column">
				<h4>Have any questions? Visit our <a href="/faq">FAQ</a></h4>
			</div>
			</section>

			<?php edit_post_link( __( 'Edit', APP_TD ), '<span class="edit-link">', '</span>' ); ?>

		</article>

		<?php appthemes_after_page(); ?>

	<?php endwhile; ?>

	<?php appthemes_after_page_loop(); ?>

</div>

