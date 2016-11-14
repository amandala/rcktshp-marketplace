<?php

add_action( 'show_user_profile', 'rcktshp_freelancer_profile_fields' );
add_action( 'edit_user_profile', 'rcktshp_freelancer_profile_fields' );


add_action( 'personal_options_update', 'rcktshp_save_freelancer_profile_fields' );
add_action( 'edit_user_profile_update', 'rcktshp_save_freelancer_profile_fields' );

function display_frelancer_education($user = ''){

	?>
		<div class="row">
			<div class="large-6 columns form-field">
				<label>Institution</label>
				<input type="text" name="edu_name" class="text regular-text" id="edu_name" maxlength="200" value="<?php echo esc_attr( get_the_author_meta( 'edu_name', $user->ID ) ); ?>" />
			</div>
			<div class="large-6 columns form-field">
				<label>Program</label>
				<input type="text" name="edu_degree" class="text regular-text" id="edu_degree" value="<?php echo esc_attr( get_the_author_meta( 'edu_degree', $user->ID ) ); ?>" maxlength="200" />
			</div>

		</div>
		<div class="row">
			<div class="large-12 columns form-field">
				<label>Details</label>
				<textarea name="edu_details" class="text regular-text" id="edu_details"  ><?php echo esc_attr( get_the_author_meta( 'edu_details', $user->ID ) ); ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="large-3 columns form-field">
				<label>Start Date</label>
				<input type="date" name="edu_start" id="edu_start" value="<?php echo esc_attr( get_the_author_meta( 'edu_start', $user->ID ) ); ?>" placeholder="yyyy-mm-dd" />
			</div>
			<div class="large-3 columns form-field">
				<label>End Date</label>
				<input type="date" name="edu_end" id="edu_end" value="<?php echo esc_attr( get_the_author_meta( 'edu_end', $user->ID ) ); ?>" placeholder="yyyy-mm-dd" />
			</div>

			<div class="large-4 columns form-field">
				<label>GPA</label>
				<input type="range" min="2.0" max="4.0" step="0.1"  onchange="updateGpaBox(this.value);" id="gpa" value="<?php echo esc_attr( get_the_author_meta( 'edu_gpa', $user->ID ) ); ?>"/>
			</div>
			<div class="large-2 columns form-field"><input type="text" id="edu_gpa" name="edu_gpa" value="<?php echo esc_attr( get_the_author_meta( 'edu_gpa', $user->ID ) ); ?>" onchange="updateGpaSlider(this.value);"/ ></div>
		</div>


	<?php

}

function display_freelancer_work($user = '', $num = 1){
	if($num === 2 || $num === 3){
		echo "<hr class='seperator' id='we-seperator" .$num. "' />";
	}
	?>
	<div id='freelancer_work<?php echo $num ?>' >

			<div class="row">
				<div class="large-6 columns form-field">
					<label>Company</label>
					<input type="text" name="we_location<?php echo $num ?>" class="text regular-text" id="we_location<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'we_location'.$num, $user->ID ) ); ?>" maxlength="200" />
				</div>
				<div class="large-6 columns form-field">
					<label>Position</label>
					<input type="text" name="we_position<?php echo $num ?>" class="text regular-text" id="we_position<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'we_position'.$num, $user->ID ) ); ?>" maxlength="200" />
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns form-field">
					<label>Start Date</label>
					<input type="date" name="we_start<?php echo $num ?>" id="we_start<?php echo $num ?>"  placeholder="yyyy-mm-dd" value="<?php echo esc_attr( get_the_author_meta( 'we_start'.$num, $user->ID ) ); ?>" />
				</div>
				<div class="large-4 columns form-field">
					<label>End Date</label>
					<input type="date" name="we_end<?php echo $num ?>" id="we_end<?php echo $num ?>" placeholder="yyyy-mm-dd" value="<?php echo esc_attr( get_the_author_meta( 'we_end'.$num, $user->ID ) ); ?>" <?php
					$checked = esc_attr( get_the_author_meta( 'we_current'.$num, $user->ID ) );
					if($checked == 'true'){ echo 'disabled="true"' ;} ?>/>
				</div>
					<div class="large-2 columns form-field">
					<label>Current Position</label>
					<input type="checkbox" name="we_current<?php echo $num ?>" id="we_current<?php echo $num ?>"  placeholder="yyyy-mm-dd" value="true" <?php
					$checked = esc_attr( get_the_author_meta( 'we_current'.$num, $user->ID ) );
					if($checked == 'true'){ echo 'checked' ;} ?>/>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns form-field">
					<label>Details</label>
					<textarea name="we_details<?php echo $num ?>" class="text regular-text" id="we_details<?php echo $num ?>"  ><?php echo esc_attr( get_the_author_meta( 'we_details'.$num, $user->ID ) ); ?></textarea>
				</div>
			</div>

			<button id="new-work<?php echo $num ?>" type="button" class='show-more'>+</button>
		</div>

	<?php
}

function update_freelacer_work($user_id, $num){
	update_usermeta( $user_id, 'we_location'.$num, $_POST['we_location'.$num] );
	update_usermeta( $user_id, 'we_position'.$num, $_POST['we_position'.$num] );
	update_usermeta( $user_id, 'we_details'.$num, $_POST['we_details'.$num] );
	update_usermeta( $user_id, 'we_start'.$num, $_POST['we_start'.$num] );
	update_usermeta( $user_id, 'we_end'.$num, $_POST['we_end'.$num] );
	update_usermeta( $user_id, 'we_current'.$num, $_POST['we_current'.$num] );
}

function display_frelancer_awards($user = '', $num = 1){
	if($num === 2 || $num === 3){
		echo "<hr class='seperator' id='aw-seperator" .$num. "' />";
	}
	?>
	<div id="freelancer_award<?php echo $num ?>" >

			<div class="row">
				<div class="large-8 columns form-field">
					<label>Name of Award</label>
					<input type="text" name="awards_name<?php echo $num ?>" class="text regular-text" id="awards_name<?php echo $num ?>" maxlength="200" value="<?php echo esc_attr( get_the_author_meta( 'awards_name'.$num, $user->ID ) ); ?>" />
				</div>
				<div class="large-4 columns form-field">
					<label>Date Received</label>
					<input type="date" name="awards_date<?php echo $num ?>" class="text regular-text"  placeholder="yyyy-mm-dd" id="awards_date<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'awards_date'.$num, $user->ID ) ); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns form-field">
					<label>Details</label>
					<textarea name="awards_details<?php echo $num ?>" class="text regular-text" id="awards_details<?php echo $num ?>"  ><?php echo esc_attr( get_the_author_meta( 'awards_details'.$num, $user->ID ) ); ?></textarea>
				</div>
			</div>
			<button id="new-award<?php echo $num ?>" type="button" class='show-more'>+</button>
		</div>


	<?php

}

function update_freelancer_awards($user_id, $num){
	update_usermeta( $user_id, 'awards_name'.$num, $_POST['awards_name'.$num] );
	update_usermeta( $user_id, 'awards_date'.$num, $_POST['awards_date'.$num] );
	update_usermeta( $user_id, 'awards_details'.$num, $_POST['awards_details'.$num] );
}

function display_freelancer_volunteer($user = '', $num = 1){
	if($num === 2 || $num === 3){
		echo "<hr class='seperator' id='vol-seperator" .$num. "' />";
	}
	?>
	<div id='freelancer_volunteer<?php echo $num ?>' >

			<div class="row">
				<div class="large-6 columns form-field">
					<label>Company</label>
					<input type="text" name="vo_location<?php echo $num ?>" class="text regular-text" id="vo_location<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'vo_location'.$num, $user->ID ) ); ?>" maxlength="200" />
				</div>
				<div class="large-6 columns form-field">
					<label>Position</label>
					<input type="text" name="vo_position<?php echo $num ?>" class="text regular-text" id="vo_position<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'vo_position'.$num, $user->ID ) ); ?>" maxlength="200" />
				</div>
			</div>
			<div class="row">
				<div class="large-4 columns form-field">
					<label>Start Date</label>
					<input type="date" name="vo_start<?php echo $num ?>" id="vo_start<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'vo_start'.$num, $user->ID ) ); ?>"  placeholder="yyyy-mm-dd"/>
				</div>
				<div class="large-2 columns form-field">
					<label>One-time Position</label>
					<input type="checkbox" name="vo_one<?php echo $num ?>" id="vo_one<?php echo $num ?>" value="true" <?php
					$checked_one = esc_attr( get_the_author_meta( 'vo_one'.$num, $user->ID ) );
					$checked_curr = esc_attr( get_the_author_meta( 'vo_current'.$num, $user->ID ) );
					if($checked_one == 'true'){ echo 'checked' ;} else if($checked_curr){ echo 'disabled="true"';} ?>/>
				</div>
				<div class="large-4 columns form-field">
					<label>End Date</label>
					<input type="date" name="vo_end<?php echo $num ?>" id="vo_end<?php echo $num ?>"  placeholder="yyyy-mm-dd"  value="<?php echo esc_attr( get_the_author_meta( 'vo_end'.$num, $user->ID ) ); ?>" <?php
					$checked_one = esc_attr( get_the_author_meta( 'vo_one'.$num, $user->ID ) );
					$checked_curr = esc_attr( get_the_author_meta( 'vo_current'.$num, $user->ID ) );
					if($checked_one == 'true' || $checked_curr == 'true'){ echo 'disabled="true"' ;} ?>/>
				</div>
				<div class="large-2 columns form-field">
					<label>Current Position</label>
					<input type="checkbox" name="vo_current<?php echo $num ?>" id="vo_current<?php echo $num ?>" value="true" <?php
					$checked_curr = esc_attr( get_the_author_meta( 'vo_current'.$num, $user->ID ) );
					$checked_one = esc_attr( get_the_author_meta( 'vo_one'.$num, $user->ID ) );
					if($checked_curr == 'true'){ echo 'checked' ;} elseif($checked_one == 'true'){ echo 'disabled="true"' ;} ?>
					/>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns form-field">
					<label>Details</label>
					<textarea name="vo_details<?php echo $num ?>" class="text regular-text" id="vo_details<?php echo $num ?>"  ><?php echo esc_attr( get_the_author_meta( 'vo_details'.$num, $user->ID ) ); ?></textarea>
				</div>
			</div>

			<button id="new-vol<?php echo $num ?>" type="button" class='show-more'>+</button>
		</div>

	<?php
}

function update_freelancer_volunteer($user_id, $num){
	update_usermeta( $user_id, 'vo_location'.$num, $_POST['vo_location'.$num] );
	update_usermeta( $user_id, 'vo_position'.$num, $_POST['vo_position'.$num] );
	update_usermeta( $user_id, 'vo_details'.$num, $_POST['vo_details'.$num] );
	update_usermeta( $user_id, 'vo_start'.$num, $_POST['vo_start'.$num] );
	update_usermeta( $user_id, 'vo_end'.$num, $_POST['vo_end'.$num] );
	update_usermeta( $user_id, 'vo_one'.$num, $_POST['vo_one'.$num] );
	update_usermeta( $user_id, 'vo_current'.$num, $_POST['vo_current'.$num] );
}

function display_frelancer_certification($user = '', $num = 1){
	if($num === 2 || $num === 3){
		echo "<hr class='seperator' id='cert-seperator" .$num. "' />";
	}
	?>
	<div id="freelancer_certification<?php echo $num ?>" >

			<div class="row">
				<div class="large-8 columns form-field">
					<label>Name of Certification</label>
					<input type="text" name="cert_name<?php echo $num ?>" class="text regular-text" id="cert_name<?php echo $num ?>" maxlength="200" value="<?php echo esc_attr( get_the_author_meta( 'cert_name'.$num, $user->ID ) ); ?>" />
				</div>
				<div class="large-4 columns form-field">
					<label>Date Received</label>
					<input type="date" name="cert_date<?php echo $num ?>" class="text regular-text" id="cert_date<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'cert_date'.$num, $user->ID ) ); ?>"  placeholder="yyyy-mm-dd" />
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns form-field">
					<label>Details</label>
					<textarea name="cert_details<?php echo $num ?>" class="text regular-text" id="cert_details<?php echo $num ?>"  ><?php echo esc_attr( get_the_author_meta( 'cert_details'.$num, $user->ID ) ); ?></textarea>
				</div>
			</div>
			<button id="new-cert<?php echo $num ?>" type="button" class='show-more'>+</button>
		</div>


	<?php

}

function update_freelancer_certification($user_id, $num){
	update_usermeta( $user_id, 'cert_name'.$num, $_POST['cert_name'.$num] );
	update_usermeta( $user_id, 'cert_date'.$num, $_POST['cert_date'.$num] );
	update_usermeta( $user_id, 'cert_details'.$num, $_POST['cert_details'.$num] );
}

function display_freelancer_organization($user= '', $num = 1){
	if($num === 2 || $num === 3){
		echo "<hr class='seperator' id='org-seperator" .$num. "' />";
	}
	?>
	<div id='freelancer_organization<?php echo $num ?>' >

			<div class="row">
				<div class="large-6 columns form-field">
					<label>Organization</label>
					<input type="text" name="org_location<?php echo $num ?>" class="text regular-text" id="org_location<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'org_location'.$num, $user->ID ) ); ?>" maxlength="200" />
				</div>
				<div class="large-6 columns form-field">
					<label>Position</label>
					<input type="text" name="org_position<?php echo $num ?>" class="text regular-text" id="org_position<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'org_position'.$num, $user->ID ) ); ?>" maxlength="200" />
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns form-field">
					<label>Start Date</label>
					<input type="date" name="org_start<?php echo $num ?>" id="org_start<?php echo $num ?>" value="<?php echo esc_attr( get_the_author_meta( 'org_start'.$num, $user->ID ) ); ?>"  placeholder="yyyy-mm-dd"/>
				</div>
				<div class="large-4 columns form-field">
					<label>End Date</label>
					<input type="date" name="org_end<?php echo $num ?>" id="org_end<?php echo $num ?>"  placeholder="yyyy-mm-dd" value="<?php echo esc_attr( get_the_author_meta( 'org_end'.$num, $user->ID ) ); ?>" <?php
					$checked = esc_attr( get_the_author_meta( 'org_current'.$num, $user->ID ) );
					if($checked == 'true'){ echo 'disabled="true"' ;} ?>/>
				</div>
					<div class="large-2 columns form-field">
					<label>Current Position</label>
					<input type="checkbox" name="org_current<?php echo $num ?>" id="org_current<?php echo $num ?>" value="true" <?php
					$checked = esc_attr( get_the_author_meta( 'org_current'.$num, $user->ID ) );
					if($checked == 'true'){ echo 'checked' ;} ?>/>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns form-field">
					<label>Details</label>
					<textarea name="org_details<?php echo $num ?>" class="text regular-text" id="org_details<?php echo $num ?>"  ><?php echo esc_attr( get_the_author_meta( 'org_details'.$num, $user->ID ) ); ?></textarea>
				</div>
			</div>

			<button id="new-org<?php echo $num ?>" type="button" class='show-more'>+</button>
		</div>

	<?php
}

function update_freelancer_organization($user_id, $num){
	update_usermeta( $user_id, 'org_location'.$num, $_POST['org_location'.$num] );
	update_usermeta( $user_id, 'org_position'.$num, $_POST['org_position'.$num] );
	update_usermeta( $user_id, 'org_details'.$num, $_POST['org_details'.$num] );
	update_usermeta( $user_id, 'org_start'.$num, $_POST['org_start'.$num] );
	update_usermeta( $user_id, 'org_end'.$num, $_POST['org_end'.$num] );
	update_usermeta( $user_id, 'org_current'.$num, $_POST['org_current'.$num] );
}




function rcktshp_freelancer_profile_fields( $user ) {
		$role = $user->roles[0];
	?>

	<table class="form-table">


		<?php
		// IF the user is a freelancer or an employer, display the custom fields for freelancers
		if($role === 'employer_freelancer' || $role === 'freelancer'){
			echo "<h3>Education</h3>";
			display_frelancer_education($user);

			echo "<h3>Work Experience</h3>";
			display_freelancer_work($user, 1);
			display_freelancer_work($user, 2);
			display_freelancer_work($user, 3);

			echo "<h3>Organizations and Clubs</h3>";
			display_freelancer_organization($user, 1);
			display_freelancer_organization($user, 2);
			display_freelancer_organization($user, 3);

			echo "<h3>Awards</h3>";
			display_frelancer_awards($user, 1);
			display_frelancer_awards($user, 2);
			display_frelancer_awards($user, 3);

			echo "<h3>Certifications</h3>";
			display_frelancer_certification($user, 1);
			display_frelancer_certification($user, 2);
			display_frelancer_certification($user, 3);

			echo "<h3>Volunteer Experience</h3>";
			display_freelancer_volunteer($user, 1);
			display_freelancer_volunteer($user, 2);
			display_freelancer_volunteer($user, 3);
		}
		elseif($role === 'employer'){
			echo "<h3>Awards</h3>";
			display_frelancer_awards($user, 1);
			display_frelancer_awards($user, 2);
			display_frelancer_awards($user, 3);

			echo "<h3>Organizations and Clubs</h3>";
			display_freelancer_organization($user, 1);
			display_freelancer_organization($user, 2);
			display_freelancer_organization($user, 3);
		}


		?>


 		<!-- TAX INFO  display for all users regardless of role-->
		<div class="row">
			<div class="large-12 columns form-field">
			<h3>Tax Information</h3>
				<label>Please select the Province, Territory or State where you file your taxes</label>
				<select id="province" class="input" type="text" value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>" name="province">
				<option value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>"><?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?></option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AB">Alberta</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="BC">British Columbia</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="DC">District of Columbia</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MB">Manitoba</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NB">New Brunswick</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NL">Newfoundland and Labrador</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="NT">Northwest Territories</option>
				<option value="NS">Nova Scotia</option>
				<option value="NU">Nunavut</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="ON">Ontario</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="PE">Prince Edward Island</option>
				<option value="PR">Puerto Rico</option>
				<option value="QC">Quebec</option>
				<option value="RI">Rhode Island</option>
				<option value="SK">Saskatchewan</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
				<option value="YT">Yukon</option>
				</select>
			</div>
		</div>


	</table>


<script type="text/javascript">

	function show_second_div(div, seperator, button){
		jQuery(div).hide();
	    jQuery(seperator).hide();
	    jQuery(button).on("click", function(){
	        jQuery(div).slideDown();
	        jQuery(button).hide();
	        jQuery(seperator).show();
	    });
	}

	function show_third_div(div, seperator, button, button2){
		jQuery(div).hide();
	    jQuery(seperator).hide();
	    jQuery(button).on("click", function(){
	        jQuery(div).slideDown();
	        jQuery(seperator).show();
	        jQuery(button).hide();
	        jQuery(button2).hide();
	    });
	}

	show_second_div("#freelancer_work2", "#we-seperator2", "#new-work1" );
	show_third_div("#freelancer_work3", "#we-seperator2", "#new-work2", "#new-work3" );


	//open up extra entries for work expreience, awards, volunteering and remove the "+" buttons
	jQuery(function(){


	    jQuery("#freelancer_award2").hide();
	    jQuery("#aw-seperator2").hide();
	    jQuery("#new-award1").on("click", function(){
	        jQuery("#freelancer_award2").slideDown();
	        jQuery("#new-award1").hide();
            jQuery("#aw-seperator2").show();
	    });

	    jQuery("#freelancer_award3").hide();
	    jQuery("#aw-seperator3").hide();
	    jQuery("#new-award2").on("click", function(){
	        jQuery("#freelancer_award3").slideDown();
	        jQuery("#new-award2").hide();
	        jQuery("#new-award3").hide();
	        jQuery("#aw-seperator3").show();
	    });

	    jQuery("#freelancer_volunteer2").hide();
	    jQuery("#vol-seperator2").hide();
	    jQuery("#new-vol1").on("click", function(){
	        jQuery("#freelancer_volunteer2").slideDown();
	        jQuery("#new-vol1").hide();
	         jQuery("#vol-seperator2").show();
	    });

	    jQuery("#freelancer_volunteer3").hide();
	      jQuery("#vol-seperator3").hide();
	    jQuery("#new-vol2").on("click", function(){
	        jQuery("#freelancer_volunteer3").slideDown();
	        jQuery("#new-vol2").hide();
	        jQuery("#new-vol3").hide();
	        jQuery("#vol-seperator3").show();
	    });

		jQuery("#freelancer_certification2").hide();
	   	jQuery("#cert-seperator2").hide();
	    jQuery("#new-cert1").on("click", function(){
	        jQuery("#freelancer_certification2").slideDown();
	        jQuery("#new-cert1").hide();
	        jQuery("#cert-seperator2").show();
	    });



	    jQuery("#freelancer_certification3").hide();
	    jQuery("#cert-seperator3").hide();
	    jQuery("#new-cert2").on("click", function(){
	        jQuery("#freelancer_certification3").slideDown();
	        jQuery("#new-cert2").hide();
	        jQuery("#new-cert3").hide();
	        jQuery("#cert-seperator3").show();
	    });

	   	jQuery("#freelancer_organization2").hide();
	   	jQuery("#org-seperator2").hide();
	    jQuery("#new-org1").on("click", function(){
	        jQuery("#freelancer_organization2").slideDown();
	        jQuery("#new-org1").hide();
	        jQuery("#org-seperator2").show();
	    });

	    jQuery("#freelancer_organization3").hide();
	    jQuery("#org-seperator3").hide();
	    jQuery("#new-org2").on("click", function(){
	        jQuery("#freelancer_organization3").slideDown();
	        jQuery("#new-org2").hide();
	        jQuery("#new-org3").hide();
	        jQuery("#org-seperator3").show();
	    });

	    // Dissable the end date field and remove any existing date if 'current' checkbox clicked
	    jQuery('#we_current1').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#we_end1").prop('disabled', true);
	             jQuery("#we_end1").val('');
	        }
	        else{
	        	 jQuery("#we_end1").prop('disabled', false);
	        }
    	});

    	jQuery('#we_current2').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#we_end2").prop('disabled', true);
	             jQuery("#we_end2").val('');
	        }
	        else{
	        	 jQuery("#we_end2").prop('disabled', false);
	        }
    	});

    	jQuery('#we_current3').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#we_end3").prop('disabled', true);
	             jQuery("#we_end3").val('');
	        }
	        else{
	        	 jQuery("#we_end3").prop('disabled', false);
	        }
    	});

	    // Dissable the end date field and remove any existing date if 'current' checkbox clicked for ORGANIATION
	    jQuery('#org_current1').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#org_end1").prop('disabled', true);
	             jQuery("#org_end1").val('');
	        }
	        else{
	        	 jQuery("#org_end1").prop('disabled', false);
	        }
    	});

    	jQuery('#org_current2').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#org_end2").prop('disabled', true);
	             jQuery("#org_end2").val('');
	        }
	        else{
	        	 jQuery("#org_end2").prop('disabled', false);
	        }
    	});

    	jQuery('#we_current3').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#we_end3").prop('disabled', true);
	             jQuery("#we_end3").val('');
	        }
	        else{
	        	 jQuery("#we_end3").prop('disabled', false);
	        }
    	});

    	//dissable end date for volunteer expereience if 'one-time' checkbox checked

    	jQuery('#vo_one1').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#vo_end1").prop('disabled', true);
	             jQuery("#freelancer_volunteer1 > div:nth-child(3) > div:nth-child(4) > span:nth-child(3)").removeClass("checked");
	             jQuery("#vo_current1").prop('disabled', true);
	             jQuery("#vo_end1").val('');
	        }
	        else{
	        	 jQuery("#vo_end1").prop('disabled', false);
	        	 jQuery("#vo_current1").prop('disabled', false);
	        }
    	});

    	 jQuery('#vo_one2').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#vo_end2").prop('disabled', true);
	             jQuery("#freelancer_volunteer2 > div:nth-child(3) > div:nth-child(4) > span:nth-child(3)").removeClass("checked");
	             jQuery("#vo_current2").prop('disabled', true);
	             jQuery("#vo_end2").val('');
	        }
	        else{
	        	 jQuery("#vo_end2").prop('disabled', false);
	        	 jQuery("#vo_current2").prop('disabled', false);
	        }
    	});

    	jQuery('#vo_one3').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#vo_end3").prop('disabled', true);
	             jQuery("#freelancer_volunteer3 > div:nth-child(3) > div:nth-child(4) > span:nth-child(3)").removeClass("checked");
	             jQuery("#vo_current3").prop('disabled', true);
	             jQuery("#vo_end3").val('');
	        }
	        else{
	        	 jQuery("#vo_end3").prop('disabled', false);
	        	 jQuery("#vo_current3").prop('disabled', false);
	        }
    	});

    	jQuery('#vo_current1').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#vo_one1").prop('disabled', true);
	             jQuery("#vo_end1").prop('disabled', true);
	             jQuery("#freelancer_volunteer1 > div:nth-child(3) > div:nth-child(2) > span:nth-child(3)").removeClass("checked");
	              jQuery("#vo_end1").val('');
	        }
	        else{
	        	 jQuery("#vo_one1").prop('disabled', false);
	        	 jQuery("#vo_end1").prop('disabled', false);
	        }
    	});


    	 jQuery('#vo_current').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#vo_one2").prop('disabled', true);
	             jQuery("#vo_end2").prop('disabled', true);
	             jQuery("#freelancer_volunteer2 > div:nth-child(3) > div:nth-child(2) > span:nth-child(3)").removeClass("checked");
	              jQuery("#vo_end2").val('');
	        }
	        else{
	        	 jQuery("#vo_one2").prop('disabled', false);
	        	 jQuery("#vo_end2").prop('disabled', false);
	        }
    	});


    	 jQuery('#vo_current3').change(function() {
	        if(jQuery(this).is(":checked")) {
	             jQuery("#vo_one3").prop('disabled', true);
	             jQuery("#vo_end3").prop('disabled', true);
	             jQuery("#freelancer_volunteer3 > div:nth-child(3) > div:nth-child(2) > span:nth-child(3)").removeClass("checked");
	              jQuery("#vo_end3").val('');
	        }
	        else{
	        	 jQuery("#vo_one3").prop('disabled', false);
	        	 jQuery("#vo_end").prop('disabled', true);
	        }
    	});
	});


	function updateGpaBox(val) {
	  document.getElementById('edu_gpa').value=val;
	}

	function updateGpaSlider(val) {
	  document.getElementById('gpa').value=val;
	}


</script>

<?php

}


function rcktshp_save_freelancer_profile_fields( $user_id) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'edu_name', $_POST['edu_name'] );
	update_usermeta( $user_id, 'edu_degree', $_POST['edu_degree'] );
	update_usermeta( $user_id, 'edu_start', $_POST['edu_start'] );
	update_usermeta( $user_id, 'edu_end', $_POST['edu_end'] );
	update_usermeta( $user_id, 'edu_gpa', $_POST['edu_gpa'] );
	update_usermeta( $user_id, 'edu_details', $_POST['edu_details'] );


	update_freelacer_work($user_id, 1);
	update_freelacer_work($user_id, 2);
	update_freelacer_work($user_id, 3);

	update_freelancer_awards($user_id, 1);
	update_freelancer_awards($user_id, 2);
	update_freelancer_awards($user_id, 3);

	update_freelancer_volunteer($user_id, 1);
	update_freelancer_volunteer($user_id, 2);
	update_freelancer_volunteer($user_id, 3);

	update_freelancer_certification($user_id, 1);
	update_freelancer_certification($user_id, 2);
	update_freelancer_certification($user_id, 3);

	update_freelancer_organization($user_id, 1);
	update_freelancer_organization($user_id, 2);
	update_freelancer_organization($user_id, 3);

	update_usermeta( $user_id, 'province', $_POST['province'] );



}



?>
