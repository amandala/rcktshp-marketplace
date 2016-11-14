<div class="section-head">
	<h1><?php echo $title; ?></h1>
</div>

<div class="end-no-purchase">

	<fieldset>

		<div class="large-12 columns">
			<?php if ( 'publish' == get_post_status( $project->ID ) ): ?>

				<p><?php echo sprintf( __( 'Your project was %s with success and is now live!', APP_TD ), $relisted ? __( 'relisted', APP_TD ) : __( 'submitted', APP_TD ) ); ?></p>

			<?php else: ?>

				<p><?php echo sprintf( __( 'Your project was %s and is waiting moderation.', APP_TD ), $relisted ? __( 'relisted', APP_TD ) : __( 'submitted', APP_TD ) ); ?></p>

			<?php endif; ?>

			<?php do_action( 'app_project_form_end_free', $project, $relisted ); ?>
		</div>

	</fieldset>

	<fieldset>
		<input type="submit" class="button" value="<?php echo esc_attr( $bt_step_text ); ?>" onClick="location.href='<?php echo esc_url( $bt_url ); ?>';return false;">
	</fieldset>

</div>
