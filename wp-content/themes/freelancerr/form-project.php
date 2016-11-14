
<?php

	session_start();

	//grab the post data from the package builder
	$came_from_builder ;
	$package_deets = $_SESSION['post_data'];
	$package_categories = array(); // holds the slug and category ID for all pacakge cateogries
	$current_user = wp_get_current_user();
	$current_user = $current_user->display_name;

	if($package_deets){
		$came_from_builder = true;
		$package = get_post($package_deets['package_id']);
		$package_meta = get_post_meta($package_deets['package_id']);
		$includes = $package_meta['includes'];
		$package_type = $package_deets['package_type']; //slug version of the category
		$package_level = $package_deets['package_level'];
	}
	else{
		$came_from_builder = false;
		$package_type = 'general'; //slug version of the category
	}

	if($_SESSION['post_data_form']){
		if (preg_match('%(<p[^>]*>.*?</p>)%i', $desc, $regs)) {
			$custom_desc = $regs[1];
		}
	}

?>

<form id="create-project-form" class="custom main" enctype="multipart/form-data" method="post"
	  action="<?php echo esc_url($form_action); ?>" xmlns="http://www.w3.org/1999/html">

		<div class="package-builder-steps">
			<img id="package-step" src="<?php echo site_url() ?>/wp-content/themes/freelancerr/images/packages/step2.png">
		</div>
		<fieldset id='project-package' class="package-fieldset">

			<label><?php _e( 'What do you need?', APP_TD ); ?></label>

			<div class="row">
				<div class="large-12 columns" >

					<ul class="small-block-grid-2" id="package-type">
						<li><a id="website" class="button package-option">Websites</a></li>
						<li><a id="social-media" class="button package-option">Social Media/Marketing</a></li>
					</ul>
					<ul class="small-block-grid-2" id="package-type">
						<li><a id="blog-content" class="button package-option">Blogging</a></li>
						<li><a id="general" class="button package-option">Custom Project</a></li>
					</ul>
				</div>
				<?php
					//for a given post type, return all
					$post_type = 'packages';
					$tax = 'package_category';
					$tax_terms = get_terms($tax);
					if ($tax_terms) {
				?>
				<div id="package-select">
					<label><?php _e( 'Choose a package', APP_TD ); ?></label>
					<?php

					foreach ($tax_terms  as $tax_term) {
						$package_categories[$tax_term->term_id] = $tax_term->slug;
					?>
					<div class="package-options" id="package-options-<?php echo $tax_term->slug; ?>">
						<ul>
					<?php
						$args=array(
							'post_type' => $post_type,
							"$tax" => $tax_term->slug,
							'post_status' => 'publish',
							'orderby' => 'meta_value_num',
							'meta_key'  => 'price',
							'order'     => 'ASC',
							'posts_per_page' => -1,
							'caller_get_posts'=> 1
						);

						$my_query = null;
						$my_query = new WP_Query($args);

						while ( $my_query->have_posts() ) : $my_query->the_post();
							$meta = get_post_meta($post->ID);
							$content =  get_post_field('post_content', $post->ID);

							?>

							<li class="package-op" id="<?php echo $post->ID; ?>">
								<input type='radio' value='<?php echo $meta['price'][0]?>' name='package-type'  id='<?php echo $post->post_name ?>'/>
								<label for='package-type'><span><?php echo $post->post_title ?></span></label><p class="package-desc"><?php echo $meta['snippet'][0] ?> for <span class="package-price">$<?php echo $meta['price'][0]?></span></p>
								<input type="hidden" name="package_id" value="<?php echo $post->ID; ?>" id="package_id">
								<input type="hidden" name="title" value="<?php echo $post->post_title; ?>" id="title">
								<input type="hidden" name="price" value="<?php echo $meta['price'][0]; ?>" id="price">
								<input type="hidden" name="content_price" value="<?php echo $meta['price'][0] + ($meta['num_units'][0] * $meta['addon_content_price'][0]); ?>" id="content_price">
								<input type="hidden" name="category" value="<?php echo $tax_term->slug ;?>" id="category_type">

								<input type="hidden" name="package_content" value="<?php echo $post->post_content; ?>" id="package_content">
								<input type="hidden" name="snippet" value="<?php echo $meta['snippet'][0] ?>" id="snippet">
								<?php
								$count =1;
								if($meta['includes']){
									foreach($meta['includes'] as $include){
										echo "<input type='hidden' class='includes' name='includes-".$count."' value='".$include."' >";
										$count ++;
									}
								} ?>

							</li>
							<?php


						endwhile;
						?>
							<li class="package-op">
								<input type="radio" value="750" name="package-type" id="custom">
								<label for='custom'><span>Custom <?php echo $tax_term->name ?></span> name your price:</label>
								<input type="number" min="0" name="package-type" id="custom-price-<?php echo $tax_term->slug; ?>" class="custom-price-input" placeholder="ex. 1000">
								<input type="hidden" name="title" value="Custom Project" id="title">
								<input type="hidden" name="category" value="<?php echo $tax_term->slug; ?>" id="category">
								<input type="hidden" name="snippet" id="snippet" value="Custom project">
								<input type="hidden" class="includes" name="includes" value="Enter your requirements in the project details box">
							</li>
						</ul>

					</div>
					<?php
						wp_reset_query();
					}
					?>
					<div class="package-options" id="package-options-general">
						<ul>
							<li class="package-op" id="general-option">
								<input type="radio" value="750" name="package-type" id="general">
								<label for='custom'><span>Custom project</span> name your price:</label>
								<input type="number" min="0" name="package-type" id="custom-price-general" class="custom-price-input" placeholder="ex. 1000">
								<input type="hidden" name="title" value="Custom Project" id="title">
								<input type="hidden" name="category" value="general" id="category">
								<input type="hidden" class="includes" name="includes" value="Enter your requirements in the project details box">
							</li>
						</ul>
					</div>
					<div class="">
						<label><?php _e( 'Content Creation Addon', APP_TD ); ?></label>
						<input type="checkbox" name="content-creation" class="content-addons" id="content-addon" > Have the freelancer choose photos and write copy.
					</div>
					<?php
				}
				?>
				</div>
			</div>


		</fieldset>

		<?php
		// ADD BACK ONCE YOU WANT TO GET THE BULLETED LIST IN ACTION
		//do_action( 'hrb_project_custom_fields', $project ); ?>

		<fieldset id='project-title'>
			<div class="row">
				<div class="large-12 columns">
					<label><?php _e( 'Project Title', APP_TD ); ?></label>
					<input id="post_title" name="post_title" tabindex="1" type="text" placeholder="<?php echo esc_attr__( 'e.g: I need a Web Developer to develop a plugin', APP_TD ); ?>" value="<?php echo esc_attr( $project->post_title ); ?>" class="required" />
				</div>
			</div>
		</fieldset>

		<fieldset id="project-category">
			<label><?php _e( 'Categories', APP_TD ); ?></label>
			<div class="row">
				<div class="large-6 columns category-dropdown">
					<div class="row">
						<div class="large-12 columns">
							<label for="category"><?php echo __( 'Category', APP_TD ); ?></label>
								<?php
									$args = array(
										'id'              => 'category',
										'name'            => '_'.HRB_PROJECTS_CATEGORY.'[]',
										'taxonomy'        => HRB_PROJECTS_CATEGORY,
										'hide_empty'      => false,
										'hierarchical'    => true,
										'depth'           => 1,
										'selected'        => $project->categories,
										'class'           => 'category-dropdown required' . ( $categories_locked ? ' locked' : '' ) ,
										'show_option_all' => __( '- Select Category -', APP_TD ),
										'orderby'         => 'name',
										'tab_index'       => 2
									);
									wp_dropdown_categories( $args );
								?>

								<?php if ( $categories_locked ): ?>
										<input name="<?php echo '_'.HRB_PROJECTS_CATEGORY.'[]'; ?>" type="hidden" value="<?php echo esc_attr( $project->categories ); ?>">
								<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="large-6 columns sub-category-dropdown">
					<div class="row">
						<div class="large-12 columns">
							<label for="sub_category"><?php echo __( 'Sub-Category', APP_TD ); ?></label>
							<select id="sub_category" name="<?php echo esc_attr( '_'.HRB_PROJECTS_CATEGORY ); ?>[]" tabindex="3" class="subcategory-dropdown" pre-selected="<?php echo esc_attr( $project->subcategories ); ?>" >
								<option value=""><?php echo __( '- Select Sub-Category -', APP_TD ); ?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<fieldset id="project-description">
			<div class="row">
				<div class="large-12 columns">
					<label><?php _e( 'Describe your project details', APP_TD ); ?><span class="small-text"> (optional)</span></label>
					<textarea id="project-details-textarea" name="post_content" tabindex="4"  ><?php echo esc_attr( $project->post_content ); ?></textarea>
				</div>
			</div>
		</fieldset>

		<fieldset id="project-skills">
				<label><?php _e( 'Skills', APP_TD ); ?></label>
			<div class="row">
				<div class="large-12 columns">
				<?php if ( hrb_charge_listings() ): ?>
					<p class="important-note"><?php echo __( '<strong>Note:</strong> Categories are locked after purchase', APP_TD ); ?></p>
				<?php endif; ?>
				</div>
			</div>

			<?php if ( hrb_get_allowed_skills_count() ): ?>

				<div class="row">
					<div class="large-12 columns">
						<div class="row">
							<div class="large-12 columns">
								<label for="skills"><?php echo __( 'Skills', APP_TD ); ?></label>
								<?php
									$args = array(
										'id'           => 'skills',
										'name'         => '_'.HRB_PROJECTS_SKILLS.'[]',
										'taxonomy'     => HRB_PROJECTS_SKILLS,
										'hide_empty'   => false,
										'hierarchical' => true,
										'selected'     => $project->skills,
										'walker'       => new HRB_OptGroup_Category_Walker,
										'depth'        => 5,
										'orderby'      => 'name',
										'echo'         => false,
										'tab_index'    => 5
									);
									$dropdown = wp_dropdown_categories( $args );

									// make this a multiple dropdown
									echo str_replace( '<select ', '<select multiple="multiple"', $dropdown );
								?>
							</div>
						</div>
					</div>
				</div>

			<?php endif; ?>

			<div class="row">
				<div class="large-12 columns">
					<div class="row">
						<div class="large-12 columns">
							<label for="tags"><?php echo __( 'Tags', APP_TD ); ?></label>
							<span class="tags-tags"></span>
							<input id="tags" name="<?php echo esc_attr( HRB_PROJECTS_TAG ); ?>" tabindex="6" type="text" class="tm-input tm-tag" placeholder="<?php echo esc_attr__( 'Add some tags for this project. e.g: mobile, web (comma separated)', APP_TD ); ?>" value="<?php echo esc_attr( $project->tags ); ?>">
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<?php do_action( 'hrb_project_custom_fields', $project ); ?>

		<fieldset id="project-budget">
			<label><?php _e( 'Budget', APP_TD ); ?></label>
			<div class="row">
				<div class="large-4 columns">
					<select id="budget_type" name="budget_type" tabindex="10">
						<?php if ( ! $hrb_options->budget_types || 'fixed' == $hrb_options->budget_types ): ?>
							<option value="fixed" <?php selected( $project->_hrb_budget_type, 'fixed' ); ?>><?php echo __( 'Fixed Price', APP_TD ); ?></option>
						<?php endif; ?>
						<?php if ( ! $hrb_options->budget_types || 'hourly' == $hrb_options->budget_types ): ?>
							<option value="hourly" <?php selected( $project->_hrb_budget_type, 'hourly' ); ?>><?php echo __( 'Per Hour', APP_TD ); ?></option>
						<?php endif; ?>
					</select>
				</div>
				<div class="large-8 columns">
					<div class="row collapse">
						<div class="large-5 columns">
							<span class="prefix"><?php _e( 'Currency', APP_TD ); ?></span>
						</div>
						<div class="large-7 columns budget-currency">
							<select id="budget_currency" name="budget_currency" tabindex="11">
								<?php foreach( hrb_get_currencies() as $key => $currency ): ?>
								<option currency-symbol="<?php echo $currency['symbol'] ?>" value="<?php echo esc_attr( $key ); ?>" <?php selected( $project->_hrb_budget_currency ? $project->_hrb_budget_currency : APP_Currencies::get_current_currency('code'), $key ); ?>><?php echo $currency['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<hr/>

			<div class="row">
				<div class="large-6 columns">
					<div class="row collapse">
						<div class="large-6 small-6 columns budget-price">
							<span class="prefix"><?php _e( 'Price', APP_TD ); ?></span>
						</div>
						<div class="large-1 small-1 columns">
							<span class="prefix selected-currency center">$</span>
						</div>
						<div class="large-5 small-5 columns">
							<input id="budget_price" name="budget_price" tabindex="12" type="text" class="required" placeholder="<?php echo esc_attr__( 'e.g: 40', APP_TD ); ?>" value="<?php echo esc_attr( $project->_hrb_budget_price ); ?>"/>
						</div>
					</div>
				</div>
				<div class="large-6 columns">
					<div class="row collapse budget-min-hours">
						<div class="large-6 small-6 columns">
							<span class="prefix"><?php _e( 'Min. Hours', APP_TD ); ?></span>
						</div>
						<div class="large-6 small-6 columns">
							<input id="hourly_min_hours" name="hourly_min_hours" tabindex="13" type="text" class="required" placeholder="<?php echo esc_attr__( 'e.g: 8', APP_TD ); ?>" value="<?php echo esc_attr( $project->_hrb_hourly_min_hours ); ?>"/>
						</div>
					</div>
				</div>
			</div>
		</fieldset>

		<?php if ( ! hrb_charge_listings() ): ?>

		<fieldset id="project-duration">
			<label><?php _e( 'Duration', APP_TD ); ?></label>
			<div class="row">
				<div class="large-8 columns">
					<div class="row collapse">
						<div class="large-6 columns">
							<span class="prefix"><?php echo __( 'Post this Project for', APP_TD ); ?></span>
						</div>
						<div class="large-3 columns">
							<input id="duration" name="duration" tabindex="14" type="text" <?php echo ( ! $hrb_options->project_duration_editable ? 'readonly' : '' ); ?> class="required" placeholder="<?php echo esc_attr__( 'e.g: 30', APP_TD ); ?>" value="<?php echo esc_attr( $project->_hrb_duration ? $project->_hrb_duration : $hrb_options->project_duration ); ?>" />
						</div>
						<div class="large-3 columns">
							<span class="postfix"><?php echo __( 'Days', APP_TD ); ?></span>
						</div>
					</div>
				</div>
			</div>
			<?php if ( $hrb_options->project_duration ): ?>
			<div class="row">
				<div class="large-8 columns">
					<div class="row">
						<div class="large-8 columns">
							<label><?php echo sprintf( __( 'Maximum days allowed is %1$d %2$s', APP_TD ), $hrb_options->project_duration, ( ! $hrb_options->project_duration_editable ? __( '(not editable)', APP_TD ) : '' ) ); ?></label>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</fieldset>

		<?php endif; ?>

		<fieldset id="optional-fields">
			<?php if ( ! $hrb_options->local_users ): ?>

				<div id="project-location" class="row">
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="large-2 small-4 columns">
								<span class="prefix"><?php _e( 'Location', APP_TD ); ?></span>
							</div>
							<div class="large-3 small-4 columns location-type">
								<select id="location_type" name="location_type" tabindex="16">

									<?php if ( ! $hrb_options->location_types || 'remote' == $hrb_options->location_types ): ?>
										<option value="remote" <?php selected( $project->_hrb_location_type, 'remote' ); ?>><?php echo __( 'Remote', APP_TD ); ?></option>
									<?php endif; ?>
									<?php if ( ! $hrb_options->location_types || 'local' == $hrb_options->location_types ): ?>
										<option selected='selected' value="local" <?php selected( $project->_hrb_location_type, 'local' ); ?>><?php echo __( 'Local', APP_TD ); ?></option>
									<?php endif; ?>
								</select>
							</div>
							<div class="large-7 columns custom-location">
								<input type="text" id="location" name="location" tabindex="17" data-geo="formatted_address" placeholder="<?php echo esc_attr__( 'e.g: New York', APP_TD ); ?>" class="required" value="<?php echo esc_attr( $project->_hrb_location ); ?>" />
								<?php
									foreach ( hrb_get_geocomplete_attributes() as $location_att ) :
										$meta_key = "_hrb_location_{$location_att}";
								?>
										<input type="hidden" id="<?php echo esc_attr( $meta_key ); ?>" name="<?php echo esc_attr( $meta_key ); ?>" data-geo="<?php echo esc_attr( $location_att ); ?>" value="<?php echo esc_attr( $project->$meta_key ); ?>" />
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>

			<?php endif; ?>

			<?php if ( $hrb_options->attachments ): ?>
			<div class="row">
				<div class="large-12 columns">
					<label><?php _e( 'Attachments', APP_TD ); ?><span class="small-text"> (optional)</span></label>
					<?php hrb_media_manager( $project->ID, array( 'id' => '_app_media' ) );  ?>
				</div>
			</div>
			<?php endif; ?>

		</fieldset>

		<?php do_action( 'hrb_project_form', $project ); ?>

		<fieldset class='no-bottom-border'>
			<?php do_action( 'hrb_project_form_fields', $project ); ?>

			<?php wp_nonce_field('hrb_post_project'); ?>

			<?php
				hrb_hidden_input_fields(
					array(
						'ID'	=> esc_attr( $project->ID ),
						'action'=> esc_attr( $action ),
					)
				);
			?>

			<input tabindex="20" type="submit" class="button orange" value="<?php echo esc_attr( $bt_step_text ); ?>" />

		</fieldset>
</form>



<?php

$tax_terms = get_terms( 'project_category');
//get the taxonomy id for web development to add the main category.
$category_code = '';
$category_name = '';

// get the project category name and id from the session data
foreach($tax_terms as $term){
	$slug = $term->slug;
	if($slug === $package_type){
		$category_code = $term->term_id;
		$category_name = $term->slug;
	}
	else if($slug === 'general'){
		$category_code = $term->term_id;
		$category_name = $term->slug;
	}
}

?>


<script>
jQuery(document).ready( function() {

	var is_a_package = '<?php echo $package_deets["package_id"] ?>';
	var package_type = "<?php echo $package_type; ?>";
	var packageCategoryArray = [];
	var currentuser = '<?php echo $current_user; ?>';
	var category_name = "<?php echo $category_name;	 ?>";
	var content_creation = "<?php echo $package_deets['addon_content']?>";
	var package_level = "<?php echo $package_level ;?>";

	function ContentSnipToTitle(action){
		if(action === 'add'){

			var packageDesc = jQuery('#app_package').val();
			var newPackageDesc = packageDesc + " - Content creation included"
			jQuery('#app_package').val(newPackageDesc);
		}
		else if(action === 'remove'){
			var packageDesc = jQuery('#app_package').val();
			var newPackageDesc = packageDesc.split('-');
			jQuery('#app_package').val(newPackageDesc[0]);
		}
	}

	function visualPrice(priceType){
		var theType = '#'+priceType;
		jQuery('.package-op').each(function(){
			var node = this;
			var price = jQuery(node).children(theType).val();

			node = jQuery(node).children('.package-desc').children('.package-price');
			jQuery(node).text('$'+price);
		});
	}

	function buildBullets(title, price, snippet){

		if(typeof price !== 'undefined'){
			var package_heading = title + ': '+ snippet ;
			return package_heading;
		}
	}

	function buildIncludes(includes){
		if(includes.length > 1){
			var includesContent = '';
			jQuery(includes).each(function(){
				includesContent = includesContent +  jQuery(this).val() + ', ';
			});
			return includesContent.slice(0, -2) + '.';
		}
	}

	/* update the project content textarea with the package defaults */
	function updateContent(package_content){
		jQuery(document).bind('DOMNodeInserted', function(e) {
			jQuery('#app_package').val(package_content);
			if(content_creation === 'on'){
				ContentSnipToTitle('add');
			}
		});
	}

	function updateContentIncludes(this_content){
		jQuery(document).bind('DOMNodeInserted', function(e) {
			jQuery('#app_package-includes').val(this_content);
		});
	}

	/* Update package price */
	function updatePrice(price){
		jQuery('#budget_price').val(price);
	}

	/* Update package price */
	function updateTitle(title){
		jQuery('#post_title').val(title + ' for ' + currentuser);
	}

	//select the appropriate radio button
	function updatePackageLevel(package_level){
		if(typeof level === 'undefined'){
			level = 'basic';
			var package_button_id = level + '-' + package_type;
			jQuery('#general-option').children('input#general').prop('checked', true) ;
		}
		else{
			var package_button_id = level + '-' + package_type;

			jQuery('#' + package_level).prop('checked', true) ;
		}
	}

	/* Update the category button selected and the options that are displayed */
	function updateCategorySection(category){
		jQuery('.package-option').removeClass('selected');
		jQuery('#'+ category).addClass('selected');
		jQuery('.package-options').hide();
		jQuery('#package-options-' + category).show();
	}

	// Get all the category ids and add them to an array for updating category on the fly
	jQuery('#category option').each(function(){
		var key = this.value;
		var value = this.text;

		if(value === 'Web Development'){
			var obj = {};
			obj['website'] = key;

			packageCategoryArray.push(obj);
		}
		else if(value === 'Social Media Management'){
			var obj = {};
			obj['social'] = key;

			packageCategoryArray.push(obj);
		}
		else if(value === 'General'){
			var obj = {};
			obj['general'] = key;

			packageCategoryArray.push(obj);
		}
		else if(value === 'Blog Content'){
			var obj = {};
			obj['blog'] = key;

			packageCategoryArray.push(obj);
		}

	});

	/** Update the pacakge category dropdown to reflect the category of the most recently selected package
	*  Params:
	*  			pacakgeCategoryArray - an arry holding objects of all the available options in the dropdown
	* 			category_name - the name to filter the array for
	* */
	function updateCategory(packageCategoryArray, category_name){
		var category_code = '';

		if(category_name === 'social-media'){
			var result = packageCategoryArray.filter(function( obj ) {
				return obj.social;
			});
			category_code = result[0].social;
		}
		else if(category_name === 'website'){
			var result = packageCategoryArray.filter(function( obj ) {
				return obj.website;
			});
			category_code = result[0].website;
		}
		else if(category_name === 'blog-content'){
			var result = packageCategoryArray.filter(function( obj ) {
				return obj.blog;
			});
				category_code = result[0].blog;
		}
		else if(category_name === 'general'){
			var result = packageCategoryArray.filter(function( obj ) {
				return obj.general;
			});
			category_code = result[0].general;
		}
		jQuery('#category').val(category_code).change(); // this is the error line!! For some reason this is why the category
		jQuery('#category option[value="'+category_code+'"]').attr("selected", "selected");

	}


	/** IF THE USER CAME FROM THE PACKAGE ARCHIVE **/

	if(is_a_package > 0) {
		var is_a_package = true;
		var package_type = "<?php echo $package_deets['package_type']; ?>";
		var title = "<?php echo $package_deets['post_title'] ?>";
		var price = "<?php echo $package_deets['package_price']; ?>";
		var snippet = "<?php echo $package_deets['snippet'] ?>";
		var content_addon = '<?php echo $package_deets['addon_content']?>';
		var level = "<?php echo $level; ?>";

		// auto populate all the necessary information for a package builder project
		jQuery('#location_type option[value="remote"]').prop('selected', true);

		// Set all the fields from the session

		updatePrice(price);
		updateTitle(title);

		updatePackageLevel(package_level);
		if (package_type !== '') {
			updateCategorySection(package_type);
		}

		var includes = jQuery('input:radio[name=package-type]:checked').siblings('input.includes');
		var content = buildBullets(title, price, snippet);
		var content2 = buildIncludes(includes);

		updateContent(content);
		updateContentIncludes(content2);

		// select the project category
		updateCategory(packageCategoryArray, package_type);


		// hide all the unnecessary form fields
		jQuery('#project-form-custom-fields').hide();
		jQuery('#project-category').hide();
		jQuery('#project-skills').hide();
		jQuery('#project-duration').hide();
		jQuery('#project-location').hide();
		jQuery('#project-budget').hide();


		/* handle content creation addons stuff */
		if(content_addon === 'on'){
			jQuery('#content-addon').attr('checked', true);

			visualPrice('content_price');

			var checkExist = setInterval(function() {
				if (jQuery('.form-custom-field').length) {

					jQuery('.custom.checkbox').addClass('checked');
					clearInterval(checkExist);
				}
			}, 100); // check every 100ms

		}
	}
	/** IF THE USER CAME STRAIGHT TO THE POST A PROJECT PAGE **/
	else{

		jQuery('#project-form-custom-fields').hide();
		jQuery('#project-category').hide();
		jQuery('#project-skills').hide();
		jQuery('#project-duration').hide();
		jQuery('#project-location').hide();
		jQuery('#project-budget').hide();;

		updatePackageLevel(level, package_type);
		if (package_type !== '') {
			updateCategorySection(package_type);
		}
		updateCategory(packageCategoryArray, package_type);
	}

	/** GENERAL ACTIONS **/

		/* update the price for custom package on paste and type*/
		var price = 0;
		jQuery('.custom-price-input').keyup( function() {
			var price = jQuery(this).val();
			updatePrice(price);
		});

		jQuery('.custom-price-input').change( function() {
			var price = jQuery(this).val();
			updatePrice(price);
		});


		/* Action : select a different package category */
		jQuery('#website').click(function (){
			updateCategorySection(this.id);
		});

		jQuery('#social-media').click(function (){
			updateCategorySection(this.id);
		});

		jQuery('#general').click(function (){
			updateCategorySection(this.id);
		});

		jQuery('#blog-content').click(function (){
			updateCategorySection(this.id);
		});

		/* ACTION: Select the checkbox for content creation */
		jQuery('.content-addons').change(function(){
			var base_price = jQuery('span.custom.radio.checked').siblings('input#price').val() ;
			var content_price = jQuery('span.custom.radio.checked').siblings('input#content_price').val() ;

			if(jQuery('.content-addons').is(":checked") ) {
				updatePrice(content_price);

				visualPrice('content_price');
				ContentSnipToTitle('add');
				jQuery('.custom.checkbox').addClass('checked');
			}
			else{
				updatePrice(base_price);
				visualPrice('price');
				ContentSnipToTitle('remove');
				jQuery('.custom.checkbox').removeClass('checked');
			}
		});


		/* ACTION: Selecting a package from the radio button options
		update the price when selecting package radio buttons with price */
		jQuery('input[type=radio][name=package-type]').change(function() {
			var price = jQuery('input:radio[name=package-type]:checked').val();

		 	var includes = jQuery('input:radio[name=package-type]:checked').siblings('input.includes');
			var title = jQuery('input:radio[name=package-type]:checked').siblings('input#title').val();
			var category_name = jQuery('input:radio[name=package-type]:checked').siblings('input#category_type').val();
			var price = jQuery('span.custom.radio.checked').siblings('input#price').val() ;
			var content_price = jQuery('span.custom.radio.checked').siblings('input#content_price').val() ;
			var snippet = jQuery('span.custom.radio.checked').siblings('input#snippet').val() ;

			//if there are includes associated with the bullet selected
			if(jQuery(includes).length){
				var content = buildBullets(title, price, snippet);
				var contentIncludes = buildIncludes(includes);
			}
			else{
				content = '';
			}

			if(jQuery('.content-addons').is(":checked") ){
				updatePrice(content_price);
			}
			else{
				updatePrice(price);
			}
			updateContent(content);
			updateContentIncludes(contentIncludes)
			updateTitle(title);
			updateCategory(packageCategoryArray, category_name);
		});
});

</script>


