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

	jQuery('#new-work').on('click',function(){
    	
	});
