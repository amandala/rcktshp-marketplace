<?php hrb_before_post_section( HRB_PROJECTS_PTYPE, 'clarification' ); ?>

<?php if ( is_user_logged_in() ) : ?>

	<?php comments_template(); ?>

<?php else: ?>

	<div id="comments" class="row">
		<div class="columns-12">
			<h5 class="no-results"><?php echo sprintf( __( 'Please <a href="%s">login</a> to reply.', APP_TD ), wp_login_url( get_permalink() . '#clarification' ) ); ?></h5>
		</div>
	</div>

<?php endif;?>

<?php hrb_after_post_section( HRB_PROJECTS_PTYPE, 'clarification' ); ?>