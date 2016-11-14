<?php
/**
 * Template Name: Create Project
 *
 * Also used as the edit project page
 *
 */
?>

<?php
session_start('package');
$package_deets = $_SESSION['post_data'];
$package_meta = get_post_meta($package_deets['package_id']);

if(! is_user_logged_in() ){
	wp_redirect( site_url( '/package-register' ) );
	exit();
}
?>

<div class="large-12 columns">
	<div class="large-10 push-1 columns create-project purchase-plans">
		<div id="project-form" class="create-projects-section large-9 medium-12 small-12 columns">
			<div class="form-wrapper">
				<?php
				appthemes_display_checkout();
				?>
			</div>
		</div>
		<div class="large-3 columns sidebar-howto" style="">
			<div class="package-form-sidebar" id="help-sidebar">
				<p>Need help?<br /> <span>Email us at <a href="mailto:help@rctkshp.com?subject=Need help posting a project">help@rcktshp.com</a></span></p>
			</div>
		</div>
		<div  class="large-3 columns sidebar-howto" id="sidebar-project-deets">
			<div class="sidebar-widget-wrap cf">
				<!-- dynamic sidebar -->
				<?php //dynamic_sidebar('hrb-create-project'); ?>

				<div class="package-form-sidebar">
					<p><span id="package-sb-name">Hover over package to see what's included</span></p>
					<div id="package-sb-includes">

					</div>
				</div>
			</div><!-- end.sidebar-widget-wrap -->
		</div><!-- end #sidebar -->
	</div>
</div>

<script>

	function updateIncludes(includes){
		jQuery('div#package-sb-includes').empty();

		var list = jQuery('div#package-sb-includes').append('<ul></ul>').find('ul');

		jQuery(includes).each( function(){
			list.append('<li>'+jQuery(this).val()+'</li>');
		});
	}

	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	if(getParameterByName('step') === 'thank_you' ){
		jQuery('div#project-form').css('width', '100%');
	}

	jQuery(document).ready(function(){
		if ( jQuery('div.end-no-purchase').length > 0 ){
			// do nothing
		}
		else{
			// resize the form
			jQuery('.create-projects-section').css('width','50% !important');
			jQuery('.create-projects-section').css('margin-left','auto !important');
			jQuery('.create-projects-section').css('margin-right','auto !important');
		}

		//sidebar stuff prepopulate with session data
		var title = "<?php echo $package_deets['post_title']?>";
		var title = title.split(' ')[0];
		var package = '#'+'<?php echo $package_deets['package_level'] ?>';
		var includes = jQuery(package).siblings('input.includes');

		jQuery('span#package-sb-name').text(title + " Package Includes");
		updateIncludes(includes);


		// Sidebar stuff on hover
		jQuery('li.package-op').hover(function(){
			var title = jQuery(this).children('input#title').val().split(' ')[0];
			var includes = jQuery(this).children('input.includes');

			jQuery('span#package-sb-name').text(title + " Package Includes");

			updateIncludes(includes);
		});

		//hide hte sidebar if not on forst step of post a project
		if(getParameterByName('step') === '' || getParameterByName('step') === 'preview' && jQuery(window).width() > 550){
			jQuery('.large-3.columns.sidebar-howto').css('display', 'block');
		}

		if( jQuery(window).width() < 800){
			jQuery('div.sidebar-howto').removeClass('large-3');
			jQuery('div.sidebar-howto').addClass('large-12');
		}
	});

</script>



