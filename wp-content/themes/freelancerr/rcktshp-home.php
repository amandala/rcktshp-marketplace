<?php
/*
Template Name: rcktshp-home
*/
?>
<?php
$current_user = wp_get_current_user();
$id = $current_user->ID;
$meta = get_user_meta($id);
$role = $meta['edfg_capabilities'];
?>


<div class="" id ="homepage-content">
	<div class="full-width-div">
		<div class="large-10 push-1 columns">
			<?php
			if(is_user_logged_in()){
				?>
					<div class="large-6 medium-12 small-12 columns" id="home-signup">
						<div class="homepage-heading bold">
							<h3>Welcome back <?php echo $current_user->display_name ?></h3>
						</div>
						<div class="home-buttons">
							<h4 class="bold">Free Ebook Download<h3>
							<p class="">Other ebooks tell you everything you should do.  Ours include step-by-step tutorials to show you how to do, what you should do.</p>
							<ul class="small-block-grid-2" id="home-ebook-download">
								<li>
									<img width="200px" src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/ebooks/home-ebook-socialmedia.gif">
									<a  target="_blank" onclick="ga('send', { hitType: 'event', eventCategory: 'Ebook',eventAction: 'click', eventLabel: 'Social' });" href="https://www.rcktshp.com/wp-content/uploads/2016/01/RCKTSHP-Social-Media-eBook.pdf" ><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/icons/DownloadButton.png"></a>
								</li>
								<li>
									<img width="200px" src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/ebooks/home-ebook-websites.gif">
									<a  target="_blank" onclick="ga('send', { hitType: 'event', eventCategory: 'Ebook',eventAction: 'click', eventLabel: 'Websites' });" href="http://www.rcktshp.com/wp-content/uploads/2016/02/RCKTSHP-Web-Development-eBook-Final.pdf" ><img src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/icons/DownloadButton.png"></a>
								</li>
							</ul>
						</div>
					</div>
				<?php
			}
			else{
				?>
				<div class="homepage-heading bold" id="home-welcome">
					<h3>Affordable help for Small Business with Websites, Online Marketing and Social Media</h3>
				</div>
				<div class="large-6 medium-12 small-12 columns" id="home-signup">

					<div class="auth-div" >
						<div class="">
							<h5>Save time, grow your business!</h5>
							<?php
							rcktshp_custom_registration( );
							?>
							<div class="home-ebook-offer">
								<h5 class="bold white">Includes Free Ebooks:</h5>
								<ul class="small-block-grid-2" id="home-ebook-download">
									<li>
										<img  src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/ebooks/home-ebook-socialmedia.gif">
									</li>
									<li>
										<img  src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/ebooks/home-ebook-websites.gif">
									</li>
								</ul>
							</div>
						</div>
					</div>

				</div>

			<?php
			}
			?>

			<div class="large-6 columns" id="home-image">

			</div>
		</div>

	</div>


	<div class="full-width-div">
		<div class="large-10 push-1 columns">
			<div class="homepage-heading">
				<h3 class="bold">Get a beautiful 1-page website for your small business</h3>
			</div>
			<a class="no-hover" href="<?php echo site_url(); ?>/one-page-website-package/">

				<div class="tile wide" id="post-tile-home">
					<h3>Single-page Business Website</h3>
					<p>Only $99</p>
				</div>
			</a>
		</div>
	</div>


	<div class="full-width-div">
		<div class="large-10 push-1 columns">
			<div class=" homepage-heading">
				<h3 class="bold">Not sure what you need?</h3>
				<h3 >Browse our Website, Social Media, and Blog Content Packages</h3>
			</div>
			<div class="tile-wrapper row">
				<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
					<li>
						<a href="<?php echo site_url(); ?>/website-packages">
							<div class="tile">
								<h3>Business Websites</h3>
								<p>From $99</p>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/social-media-packages">
							<div class="tile">
								<h3>Social Media & Marketing</h3>
								<p>From $350</p>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/blog-packages">
							<div class="tile">
								<h3>Blog Content Generation</h3>
								<p>Starting from $89</p>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/post-a-project">
							<div class="tile">
								<h3>Custom Project</h3>
								<p>You set the budget</p>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="full-width-div">
		<div class="large-10 push-1 columns">
			<div class='homepage-heading half'>
				<h3 class="centered">Hundreds of small business owners use RCKTSHP to find help to grow their business online, affordably.</h3>
			</div>
			<div class="large-6 small-12 columns home-sat-wrapper">
				<div class="home-sat">
					<div class="home-sat-q">
						<p>Thanks to RCKTSHP we had a brand  new, robust website that absolutely exceeded our expectations and will serve our needs for years to come.</p>
					</div>
					<div class="home-sat-q">
						<div class="large-12 small-12 columns home-sat-w">
							<h4>Greg Zeschuk</h4>
							<p>Executive Director, Alberta Small Brewers Association</p>
						</div>
					</div>
					<div class=" home-sat-i">
						<img class="home-sat-img" src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/home/greg.jpg">
					</div>
				</div>
			</div>
			<div class="large-6 small-12 columns home-sat-wrapper">
				<div class="home-sat">
					<div class="home-sat-q sat">
						<h4>Satisfaction Guaranteed!</h4>
						<p>Find the right person and choose to hire if they're a good fit.</p>
						<p>When you've hired, you're in control. Release payment when work is delivered completed.</p>
					</div>
					<div class=" home-sat-i">
						<img class="home-sat-img" src="<?php echo site_url()?>/wp-content/themes/freelancerr/images/home/satisfaction.png">
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script>


	function divHeightResize() {
		//for the orange boxes
		var maxHeight = -1;
		//for the top sections (sign up and image)


		var heightto = jQuery('#home-signup').height();
		jQuery('#home-image').innerHeight(heightto);

		var tiles = jQuery('.tile');
		var highest_tile = '0';
		jQuery(tiles).each( function(){
			console.log(this);
			if(this.height < highest_tile){
				highest_tile = this.height;
			}
		});

		console.log(highest_tile);

	}

	jQuery(window).on("resize", divHeightResize);
	jQuery(document).on("ready", divHeightResize);
</script>
