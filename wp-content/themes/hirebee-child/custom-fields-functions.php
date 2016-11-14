<?php

/******* ADD PROVINCE META AND DISPLAY NAME ON REGISTRATION ******/



// This function shows the form fiend on registration page
add_action('register_form','rcktshp_custom_registration_field', 0);

// This is a check to see if you want to make a field required
add_action('register_post','check_fields',10,3);

// This inserts the data
add_action('user_register', 'register_extra_fields');

// This is the forms The Two forms that will be added to the wp register page
function rcktshp_custom_registration_field(){
?>
<fieldset>
<legend>User Information</legend>
	<div class='large-6 columns'>
		<label>Please select your Province, Territory or State</label>
		<select id="user_province" class="input" type="text" value="<?php echo $_POST['province']; ?>" name="province">
		<option value="">Select Location</option>
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

	<div class='large-6 columns'>
		<label for='display_name'>Display Name: </label><input type='text' name='display_name' id='display_name' placeholder='John Doe' style='width:200px'>
	</div>
</fieldset>

<?php
}



// This function checks to see if they didn't enter them
// If no first name or last name display Error
function check_fields($login, $email, $errors) {
	global $prov, $disp;
	if ($_POST['province'] == '') {
		$errors->add('empty_realname', "<strong>ERROR</strong>: Please enter in your Province, Territory or State");
	} else {
		$prov = $_POST['province'];
	}
	if ($_POST['display_name'] == '') {
		$errors->add('empty_displayname', "<strong>ERROR</strong>: Please enter in your display name.");
	} else {
		$disp = $_POST['display_name'];
	}

}

// This is where the magic happens
function register_extra_fields($user_id, $password="", $meta=array())  {

$province = $_POST['province'];

// Enters into DB
update_user_meta($user_id, 'province', $province);


}

// change default display name format
add_action('user_register', 'registration_save_displayname', 1000);
function registration_save_displayname($user_id) {
    if ( isset( $_POST['display_name'])) {
		$disp_name = $_POST['display_name'];
		wp_update_user( array ('ID' => $user_id, 'display_name'=> $disp_name) ) ;
	}
}


// Displays the user's work experience information 
// used in the user-profile page for freelancers
// $num - the number of the work experience information in the database (eg. we_location1)
// $meta - the user's meta values from the database
function display_work_experience($num, $meta){

	?>
	<div class='profile-edu'>
		<div class='row'>
			<div class='large-12 columns' id='we-location'>
			<h4 id='meta-work'><span id='work-icon'><?php $img = site_url("wp-content/themes/hirebee-child/images/work-icon.png"); 
					echo "<img height='40px' width='40px' src='".$img."' ></span>";
					print_r($meta['we_location'.$num][0]); ?></h4>
			</div>
		</div>
		<div class='row'>
			<div class='large-12 columns' id='we-position'>
				<?php 
				if($meta['we_position' .$num]){
					print_r($meta['we_position'. $num][0]);
				}
				?>
			</div>
		</div>
		<div class='row'>
			<div class='large-12 columns' id='we-dates'>
				<?php 
				if($meta['we_start'. $num]){
					print_r($meta['we_start' . $num][0]);
				}
				if($meta['we_current'.$num]){	
					echo ' - Present';
				}
				elseif($meta['we_end'. $num]){
				echo ' - ';
					print_r($meta['we_end' .$num][0]);
					}   
				?>
			</div>
		</div>
		<div class='row'>
			<div class='large-12 columns' id='we-desc'>
				<?php
				if($meta['we_details' .$num]){
					print_r($meta['we_details' .$num][0]);
				}
				?>
			</div>
		</div>
	</div>	

	<?php
}


	function output_sidebar_meta_awards($num, $meta){
		if($meta['awards_name'.$num]){

		?>
		<div class='profile-awards'>
			<div class='row'>
				<div class='large-12 columns' id='award-name'>
				
					<h4 class='meta-award'><span id='award-icon'><?php $img = site_url("wp-content/themes/hirebee-child/images/award-icon.png"); 
						echo "<img height='40px' width='40px' src='".$img."' ></span>";
						print_r($meta['awards_name'.$num][0]); ?></h4>
				</div>
			</div>	
			<div class='row'>
				<div class='large-12 columns' id='awards-date'>
					Received: <?php print_r($meta['awards_date'.$num][0]);  ?>
				</div>
			</div>
			<div class='row profile'>
				<div class='large-12 columns' id='awards_details'>
				<?php 
				if($meta['awards_details'.$num]){
					print_r($meta['awards_details'.$num][0]);	
					}
				?>
				</div>
			</div>
		</div>

		<?php	
		} 
	}

	function output_sidebar_meta_certs($num, $meta){
		if($meta['cert_name'.$num]){

		?>
		<div class='profile-certs'>
			<div class='row'>
				<div class='large-12 columns' id='cert-name'>
				
					<h4 class='meta-cert'><span id='cert-icon'><?php $img = site_url("wp-content/themes/hirebee-child/images/award-icon.png"); 
						echo "<img height='40px' width='40px' src='".$img."' ></span>";
						print_r($meta['cert_name'.$num][0]); ?></h4>
				</div>
			</div>	
			<div class='row'>
				<div class='large-12 columns' id='cert-date'>
					Received: <?php print_r($meta['cert_date'.$num][0]);  ?>
				</div>
			</div>
			<div class='row profile'>
				<div class='large-12 columns' id='cert_details'>
				<?php 
				if($meta['cert_details'.$num]){
					print_r($meta['cert_details'.$num][0]);	
					}
				?>
				</div>
			</div>
		</div>

		<?php	
		} 
	}

function output_sidebar_meta_orgs($num, $meta){

	?>
	<div class='profile-org'>
		<div class='row'>
			<div class='large-12 columns' id='org-location'>
			<h4 id='meta-work'><span id='org-icon'><?php $img = site_url("wp-content/themes/hirebee-child/images/work-icon.png"); 
					echo "<img height='40px' width='40px' src='".$img."' ></span>";
					print_r($meta['org_location'.$num][0]); ?></h4>
			</div>
		</div>
		<div class='row'>
			<div class='large-12 columns' id='org-position'>
				<?php 
				if($meta['org_position' .$num]){
					print_r($meta['org_position'. $num][0]);
				}
				?>
			</div>
		</div>
		<div class='row'>
			<div class='large-12 columns' id='we-dates'>
				<?php 
				if($meta['org_start'. $num]){
					print_r($meta['org_start' . $num][0]);
				}
				if($meta['org_current'.$num]){	
					echo ' - Present';
				}
				elseif($meta['org_end'. $num]){
				echo ' - ';
					print_r($meta['org_end' .$num][0]);
					}   
				?>
			</div>
		</div>
		<div class='row profile'>
			<div class='large-12 columns' id='org-desc'>
				<?php
				if($meta['org_details' .$num]){
					print_r($meta['org_details' .$num][0]);
				}
				?>
			</div>
		</div>
	</div>	

	<?php
}