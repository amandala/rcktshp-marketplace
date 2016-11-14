<form id="preview-project-form" class="custom main" method="post" action="<?php echo esc_url( $form_action ); ?>">
	<div class="package-builder-steps">
		<img id="package-step" src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/packages/step3.png">
	</div>
	<fieldset class="preview-fieldset">

		<?php foreach( $preview_fields as $label => $value ):
		if($label !== "Skills" && $label !== 'Tags' && $label !== 'Category' && $label !== "Duration" && $label !== "Location") { ?>

			<div class="row collapse field-preview">
				<?php

				if($preview_fields['Package Details']){

				}

				if ($label === 'Title') {
					?>
					<h4 class="includes-heading"><?php echo $label; ?></h4>
					<span><?php echo $value; ?></span>
					<?php
				} else if ($label === "Description") {
					echo '<h4 class="includes-heading">Custom Details</h4>';
					echo '<span>' . $value . '</span>';
				} else if ($label === "Files") {
					echo '<h4 class="includes-heading">' . $label . '</h4>';
					echo '<span>' . $value . '</span>';
				} else {
					echo '<h4 class="includes-heading">' . $label . '</h4>';
					echo '<span>' . $value . '</span>';
				}
				?>
			</div>

			<?php
		}
		endforeach; ?>
	</fieldset>

	<?php do_action( 'hrb_project_form_preview', $project ); ?>

	<fieldset class="preview-fieldset">
		<?php do_action( 'app_project_form_preview_fields', $project ); ?>

		<?php wp_nonce_field('hrb_post_project'); ?>

		<?php hrb_hidden_input_fields( array( 'action' => $action ) ); ?>

		<?php if ( $previous_step = appthemes_get_previous_step() ) : ?>
			<a href="<?php echo esc_url( appthemes_get_step_url( $previous_step ) ); ?>">Go Back</a>
		<?php endif; ?>

		<input class="button" type="submit" value="Post Your Project, It's Free" />
	</fieldset>
</form>


