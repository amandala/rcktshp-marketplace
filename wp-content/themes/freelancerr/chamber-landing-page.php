<?php
/*
Template Name: chamber-landing-page
*/
?>

<div id="chamber-landing-page-content">
	<div class="large-10 push-1  columns">
		<h2 class="teal-header">For All The _______ You Don't Have Time For</h2>
		<div class="large-6 columns left-no-pad" id="chamber-picture-sec">
			<img alt='Rocketship welcome calgary chamber member' id="chamber-main-image" src="<?php echo site_url() ?>/wp-includes/images/chamber-landing-page/chamber-main-image.jpg">
		</div>
		<div class="large-6 columns" id="chamber-blurb-sec">
			<h3 class="chamber-heading">Welcome Chamber Member!</h3>
			<p class="bottom-no-marg">RCKTSHP is an education startup helping students gain work experience through projects with local businesses. Our site connects businesses looking for affordable help on short-term projects with #local student resources.</p>
			<p>How RCKTSHP works:</p>
			<ol>
				<li>Post projects with your requirements. Students apply to the project with proposals.</li>
				<li>Check out user profiles for skills, a history of other projects they’ve worked on, and their overall rating.</li>
				<li>Rate and review Freelancers and Employers</li>
			</ol>
			<div id="chamber-button-wrapper">
				<a class="chamber-button" href="<?php echo site_url()?>/post-a-project/">Post A Project <span>(Free)<span></a>
			</div>
		</div>
	</div>
	<div class="large-12 columns grey-back" id ="chamber-grey-back">
	<div class="large-10 push-1 columns left-no-pad" id="pad-bottom">
		<div class="large-6 columns">
			<h3 class="chamber-heading">Testimonial</h3>
			<div class="large-4 medium-6 small-6 columns chamber-test-img left-no-pad">
				<a href="<?php site_url() ?>/featured-employer-of-the-week-uppercut/"><img alt="rocketship testimonial" id="chamber-testimonial" src="<?php echo site_url() ?>/wp-includes/images/chamber-landing-page/chamber-testimonial.jpg"></a>
			</div>
			<div class="large-8 columns left-no-pad" id="chamber-test">
				<p>"Sometimes you just want a fresh opinion from an eager mind on a project. Ideas from RCKTSHP students on a recent marketing project really helped invigorate our thinking and get into the mind of the millennial consumer."</p>
				<p><em>- Jill Dewes, Managing Director, Uppercut</em></p>

			</div>
			<div class="browse-all">
				<a class="chamber-button" href="<?php echo site_url()?>/featured-employer-of-the-week-uppercut/">See the full story</a>
			</div>
		</div>
		<div class="large-6 columns left-no-pad">
			<h3 class="chamber-heading">How To Add Your Business to Google</h3>
			<div class="large-5 columns left-no-pad">
				<a href="<?php echo site_url() ?>/tutorials/how-to-add-your-business-to-google-in-7-easy-steps/"><img alt="rocketship tutorials" src="<?php echo site_url() ?>/wp-includes/images/chamber-landing-page/socialmedia101.jpg"></a>
			</div>
			<div class="large-7 columns left-no-pad">
				<p>Follow this 7 easy step outline to ensure your clients and customers are getting all the right information about your business on Google. </p>
			</div>
			<div class="browse-all">
				<a class="chamber-button" href="<?php echo site_url() ?>/tutorials/">Browse all Tutorials</a>
			</div>
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

.bottom-no-marg {  margin-bottom: 0.6rem;}

#pad-bottom { margin-bottom: 1rem;}

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
	border: 1px solid black;
}

.teal-header { color: #27b7c0; font-family: 'Roboto'; font-weight: 500; font-size: 2.4rem;}
 .chamber-heading { font-weight: 400;}

 div#chamber-blurb-sec ol {
  padding-left: 2.5rem;
  font-weight: 400;
}

a.chamber-button {
  background-color: #f25926;
  color: white;
  padding: .5rem;
  text-decoration: none !important;
}


#chamber-test > p:nth-child(1) {
	margin-bottom: .5rem;
}

#chamber-test > p:nth-child(2) {
	text-align: right;
}

.browse-all {
	padding-top: 1rem;
}

@media (max-width: 400px) {
	.teal-header { font-size: 1.5rem;} 
	.chamber-heading { font-size: 1rem; text-align: center; font-weight: 500;}
	p { font-size: 1rem;}
	div#chamber-button-wrapper { text-align: center;} 
	img#chamber-testimonial { top:0; left: 0;}
	div#chamber-test { padding-left: 1.1rem; }
}

</style>




