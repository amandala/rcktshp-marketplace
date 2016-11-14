<?php
/*
Template Name: chamber-landing-page
*/
?>

<div id="chamber-landing-page-content">
	<div class="large-10 push-1  columns">
		<h2 class="teal-header">For All The _______ You Don't Have Time For</h2>
		<div class="large-6 columns left-no-pad" id="chamber-picture-sec">
			<img id="chamber-main-image" src="<?php echo site_url() ?>/wp-includes/images/chamber-landing-page/chamber-main-image.jpg">
		</div>
		<div class="large-6 columns" id="chamber-blurb-sec">
			<h3 class="chamber-heading">Welcome Chamber Member!</h3>
			<p class="bottom-no-marg">RCKTSHP is an education startup helping students gain work experience thru projects with local businesses. Our Marketplace connects businesses looking for affordable help on short-term projects with #local student resources.</p>
			<p>How the RCKTSHP Marketplace works:</p>
			<ol>
				<li>Post projects with your requirements. Students apply to the project with proposals.</li>
				<li>Check out user profiles for skills, a history of other projects they’ve worked on, and their overall rating.</li>
				<li>Rate and review Freelancers and Employers</li>
			</ol>
			<div id="chamber-button-wrapper">
				<a id="chamber-button" href="<?php echo site_url()?>/post-a-project/">Post A Project <span>(Free)<span></a>
			</div>
		</div>
	</div>
	<div class="large-12 columns grey-back" id ="chamber-grey-back">
	<div class="large-10 push-1 columns left-no-pad">
		<div class="large-2 columns chamber-test-img left-no-pad">
			<img id="chamber-testimonial" src="<?php echo site_url() ?>/wp-includes/images/chamber-landing-page/chamber-testimonial.jpg">
		</div>
		<div class="large-4 columns left-no-pad">
			<h3 class="chamber-heading">Testimonial</h3>
			<p>"Sometimes you just want a fresh opinion from an eager mind on a project. Ideas from RCKTSHP students on a recent marketing project really helped invigorate our thinking and get into the mind of the millennial consumer."</p>
			<p><em>- Jill Dewes, Managing Director, Uppercut</em></p>
		</div>
		<div class="large-6 columns">
			<h3 class="chamber-heading">How To Add Your Business to Google</h3>
			<p>Follow this 7 easy step outline on <a href="http://projects.rcktshp.com/how-to-get-your-business-on-google-search-and-maps-for-free/">How to Add Your Business to Google in 7 Easy Steps</a>, to ensure your clients and customers are getting all the right information about your business on Google. </p>
			<p>Find more how-to’s for your business needs <a href="http://projects.rcktshp.com/how-to-get-your-business-on-google-search-and-maps-for-free/">here</a>.</p>
		</div>
	</div>
	</div>
	
</div>

<style type="text/css">
	
/* CHAMBER LANDING PAGE */

div#chamber-landing-page-content {
  padding-top: 1rem;
}

.left-no-pad {
  padding-left: 0;
}

.bottom-no-marg {   margin-bottom: 0.6rem;}

div#chamber-grey-back {
  margin-top: 3rem;
  padding-top: 2rem;
}

div#chamber-picture-sec {
  margin-top: .5rem;
}

img#chamber-main-image {
	width: 150%;
}
 img#chamber-testimonial {
  position: relative;
  top: 7px;
  left: -13px;
    margin-left: 1rem;
}

.teal-header { color: #27b7c0; font-family: 'Roboto'; font-weight: 500; font-size: 2.4rem;}
 .chamber-heading { font-weight: 400;}

 div#chamber-blurb-sec ol {
  padding-left: 2.5rem;
  font-weight: 400;
}

a#chamber-button {
  background-color: #f25926;
  color: white;
  padding: 1rem;
  text-decoration: none;
}

div#chamber-button-wrapper {
  margin-top: 2rem;
}
</style>




