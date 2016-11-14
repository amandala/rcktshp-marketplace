<?php

	$meta = get_user_meta($profile_author->ID);

?>

<div id="freelancer-profile-sidebar" class="large-12 columns">
	<div class="sidebar-widget-wrap cf">
		<div id="" class="widget large-12 columns widget_text">
			<div id="tabvanilla" class="widget">
 
			<ul class="tabnav">
				<li><a id='aw'>Awards</a></li>
				<li><a id='ce'>Certificates</a></li>
				<li><a id='or'>Memberships</a></li>
			</ul>
			<hr class='bio-hr'/>
			<div id="awards" class="tabdiv">
			<?php 
			if($meta['awards_name1']){
				output_sidebar_meta_awards(1, $meta); 
			}
			if($meta['awards_name2']){
				output_sidebar_meta_awards(2, $meta); 
			}
			if($meta['awards_name3']){
				output_sidebar_meta_awards(3, $meta); 
			}


			?>
			</div><!--/awards-->
			 
			<div id="certifications" class="tabdiv">
			<?php 
			if($meta['cert_name1']){
				output_sidebar_meta_certs(1, $meta); 
			}
			if($meta['cert_name2']){
				output_sidebar_meta_certs(2, $meta); 
			}
			if($meta['cert_name3']){
				output_sidebar_meta_certs(3, $meta); 
			}
			?>
			</div><!--/certs-->
			 
			<div id="organizations" class="tabdiv">
			<?php 
			if($meta['org_location1']){
				output_sidebar_meta_orgs(1, $meta); 
			}
			if($meta['org_location2']){
				output_sidebar_meta_orgs(2, $meta); 
			}
			if($meta['org_location3']){
				output_sidebar_meta_orgs(3, $meta); 
			}
			?>
			</div><!--orgs-->
			 
			</div><!--/widget-->
		</div>
	</div>
</div>


