<?php
/**
 * Template Name: Create Project
 *
 * Also used as the edit project page
 *
 */
?>
<div class="large-12 columns light-grey-back">
<div class="large-10 columns push-1 create-project purchase-plans">
	<div id="main" class="large-8 columns create-projects-section">
		<div class="form-wrapper">
			<?php

			$is_package = $_POST['is_package'];
			if($is_package === 'true'){

				echo '<div class="section-head"><h1 id="dets">Package Summary</h1></div>';
				echo '<div class="package-description">';

				$package = ucwords($_POST["package"]);
				echo "Package selected: " . $package;
				$meta = get_post_meta($_POST['package_id']);
				$includes = $meta['includes'];
				$custom = get_post_custom($_POST['package_id']);

				echo '<ul>';
				foreach($includes as $include){
					echo '<li>'.$include.'</li>';
				}

				echo '</ul>';
				echo '</div>';


				if($_POST['addon_photos_selected'] === 'on'){
					echo $custom['addon_photos_details'][0];
					echo '<br /><br />';
				}
				if($_POST['addon_content_selected'] === 'on'){
					echo $custom['addon_content_details'][0];
					echo '<br /><br />';
				}
				appthemes_display_checkout();



			}
			else{
			appthemes_display_form_progress();
			appthemes_display_checkout();
			}
			?>


		</div>
	</div>

	<div id="sidebar-howto" class="large-4 columns create-project-sidebar">
		<div class="sidebar-widget-wrap cf">
			<!-- dynamic sidebar -->
			<?php dynamic_sidebar('hrb-create-project'); ?>
		</div><!-- end .sidebar-widget-wrap -->
	</div><!-- end #sidebar -->
</div>
</div>
 <?php  $tax_terms = get_terms( 'project_category');
	//get the taxonomy id for web development to add the main category.
 	$category_code = '';
 	$subcategory_code = '';
 	foreach($tax_terms as $term){
		$slug = $term->slug;
		if($slug === "web-development"){
			$category_code = $term->term_id;
		}
		if($slug === 'wordpress'){
			$subcategory_code = $term->term_id;
		}
 	}

 ?>


<script type="text/javascript">



jQuery(document).ready(function(){ 
  jQuery('form').find("input[type=text][name=post_title]").each(function(ev)
  {
      if(!jQuery(this).val()) { 
     jQuery(this).attr("placeholder", "Provide a descriptive project title");
  }
  });

	// if the client came from the package builder
	var is_a_package = <?php echo $is_package ?>;
	var category_code = parseInt(<?php echo $category_code ?>);
	var subcategory_code = parseInt(<?php echo $subcategory_code ?>);

	console.log(subcategory_code);

	if(is_a_package){
		jQuery('#project-title').hide();
		jQuery('#project-category').hide();
		jQuery('#project-description').hide();
		jQuery('#project-skills').hide();
		jQuery('#project-budget').hide();

		//set the category to the category id retrieved above
		var element = document.getElementById('category');
		element.value = category_code;
		//select subcategory to wordpress TODO currently not working WTAF
		var element2 = document.getElementById('sub_category');
		element2.value = subcategory_code;


	}


});



 </script>
