<?php /* Template Name: about-us */ ?>


<div id="about-us-wrapper">
	<div id="hero-caption"><p>RCKTSHP helps small businesses get online and grow</p></div>
</div>
<div class="grey-back about-us-section large-6 columns" id="our-story">
	<div class="padded-wrapper">
		<h3 class="serif-heading">The Need</h3>
		<p class="sans-para">There are approximately 30 million Small Businesses in North America.</p>
			<p>Small Business is the engine of job creation and contributes approximately 30% to Canada’s GDP. Incredibly, 55% don’t even have a website.</p>
		<p class="bold">RCKTSHP connects small business and students creating #local opportunities.</p>
	</div>
</div>
<div class="about-us-section large-6 columns" id="here-to-help">
	<div class="padded-wrapper">
		<h3 class="serif-heading">We're here to help you</h3>
		<p class="sans-para">Browse our <a href="<?php echo site_url(); ?>/tutorials">tutorials</a> like how to setup a business website. or post a project that you're looking for some help with.</p>
	</div>
</div>
<div id="about-on-board" class="about-us-section large-12 columns">
	<h3 class="serif-heading centered">Get On Board!</h3>
	<p class="sans-para centered">These companies got it done with RCKTSHP freelancers.</p>

	<div class="hw-student-onboard row">
		<div class="large-10 push-1 columns">
			<div class="large-3 small-6 columns hw-onboard-hover" id="svp">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/SVP.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="asba">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/ASBA.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="bc25">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/BC25.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="green-fuse">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/GreenFuse.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="stand-command">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/StandAndCommand.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="wild-raw">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/WildAndRaw.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="catalystica">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/Catalystica.png">
			</div>
			<div class="large-3 small-6 columns hw-onboard-hover" id="within-design">
				<span class="helper"></span>
				<img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/about_us/WithinDesign.png">
			</div>

		</div>

	</div>
</div>


<script>

	function resize_tile(){
		var width = jQuery('.large-3.columns.hw-onboard-hover').outerWidth();

		jQuery('.large-3.columns.hw-onboard-hover').height(width);
	}

	jQuery(document).ready( function() {
		resize_tile();
	});
	jQuery(window).resize( function() {
		resize_tile();
	});

	jQuery( "div.hw-onboard-hover")
		.mouseenter(function() {
			var id = jQuery(this).attr('id');
			var job = '';

			switch(id){
				case 'svp':
					job = 'Server Migration';
					break;
				case 'within-design':
				case 'green-fuse':
					job = 'Web Development';
					break;
				case 'asba':
					job = 'Web Development, Design & Social Media Management';
					break;
				case 'bc25':
					job = 'Marketing & Design';
					break;
				case 'wild-raw':
					job = 'Marketing Strategy';
					break;
				case 'catalystica':
					job = 'Marketing & Content Creation';
					break;
				case 'stand-command':
					job = 'Print Collateral';
					break;
			}

			var replace_string = "<h4 class='about-hover-job'>"+job+"</h4>";
			jQuery(this).children('img').css('display', 'none'); // hide the image

			var screen_width = jQuery(window).width();
			console.log(screen_width);
			if(screen_width < 400){
				jQuery(this).children('span').css('height', '25%'); //make the helper span quater high for mobilse
			}
			else {
				jQuery(this).children('span').css('height', '40%'); //make the helper span half high
			}
			jQuery(replace_string).appendTo(this); //create the description
		})
		.mouseleave(function() {
			jQuery(this).children('img').css('display', ''); //show the image
			jQuery(this).children('span').css('height', '100%'); //make helper full high
			jQuery(this).children('h4').remove(); //remove the description
	});
</script>

