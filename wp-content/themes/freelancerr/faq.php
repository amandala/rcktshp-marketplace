<?php /* Template Name: faq */ ?>


    <section id="qa-main">

   	<div>
      <div id="faq-search">
        <div class="large-10 push-1 columns">
          <h1>Questions?</h1>
          <input type='text' placeholder="Search here..." class="clearable" />
        </div>

        <ul class="tabs">
          <div class="large-10 push-1 columns">
        		<li class="tab-link current" data-tab="tab-2"><h2 id="q-header">For Employers</h2></li>
            <li class="tab-link" data-tab="tab-1"><h2 id="q-header">For Freelancers</h2></li>
          </div>
      	</ul>
      </div>

		<div id="faq-accordion">

	      <?php

			$url = network_site_url('wp-content/themes/hirebee-child/faq.json');

			$string = file_get_contents($url);

			$questions = json_decode($string, true);

			echo '<div id="tab-1" class="tab-content">';

      echo '<div id="jump-to-section">';
      echo '<div class="large-10 push-1 columns">';
      foreach($questions['student'] as $section) {
        echo '<div class="section-item large-3 columns">';
        echo '<a href="#' . $section['anchorname'] . '">' . $section['section'] . '</a>';
        echo '</div>';
      }
      echo '</div>'; // end large-10 push-1 columns
      echo '</div>'; // end jump-to-section

			echo '<div id="faq_accordion_stu">';
      $sectionCount = 0;
			foreach ($questions['student'] as $sections) {
        echo '<div class="questiongroup">';
        echo '<div class="large-10 push-1 columns">';
        echo '<div class="large-3 push-1 columns">';
        echo '<a name="' . $sections['anchorname'] . '"></a>';
        echo '<h2>';
        echo $sections['section'];
        echo '</h2>';
        echo '</div>'; // end large-3 push-1 columns
        echo '<div class="accordion_section large-8 columns">';
        foreach ($sections['questions'] as $v) {
					echo '<h3 class="accordion-q"><i class="fa fa-plus-square"></i>';
					echo $v['q'];
					echo '</h3>';
					echo '<div class="accordion-a">';
					echo $v['a'];

					if($v["bullets"]){
						echo "<ul>";
						foreach ($v["bullets"] as $bullet) {
							echo "<li>" . $bullet['b'] . "</li>";
						}
						echo "</ul>";
          }
					echo '</div>'; // end accordion-a
          $sectionCount++;
				}
        echo '</div>'; // end accordion_section
        echo '</div>'; // end large-10 push-1 columns
        echo '</div>'; // end questiongroup

      }
			echo '</div>'; // end faq_accordion_stu
			echo '</div>'; // end tab-1

      //-------------------------
			echo '<div id="tab-2" class="tab-content current">';
      echo '<div id="jump-to-section">';
      echo '<div class="large-10 push-1 columns">';
      foreach($questions['employer'] as $section) {
        echo '<div class="section-item large-3 columns">';
        echo '<a href="#' . $section['anchorname'] . '">' . $section['section'] . '</a>';
        echo '</div>';
      }
      echo '</div>'; // end large-10 push-1 columns
      echo '</div>'; // end jump-to-section

			echo '<div id="faq_accordion_emp">';
      $sectionCount = 0;
			foreach ($questions['employer'] as $sections) {
        echo '<div class="questiongroup">';
        echo '<div class="large-10 push-1 columns">';
        echo '<div class="large-3 push-1 columns">';
        echo '<a name="' . $sections['anchorname'] . '"></a>';
        echo '<h2>';
        echo $sections['section'];
        echo '</h2>';
        echo '</div>'; // end large-3 push-1 columns
        echo '<div class="accordion_section large-8 columns">';
        foreach ($sections['questions'] as $v) {
					echo '<h3 class="accordion-q"><i class="fa fa-plus-square"></i>';
					echo $v['q'];
					echo '</h3>';
					echo '<div class="accordion-a">';
					echo $v['a'];

					if($v["bullets"]){
						echo "<ul>";
						foreach ($v["bullets"] as $bullet) {
							echo "<li>" . $bullet['b'] . "</li>";
						}
						echo "</ul>";
          }
					echo '</div>'; // end accordion-a
          $sectionCount++;
				}
        echo '</div>'; // end accordion_section
        echo '</div>'; // end large-10 push-1 columns
        echo '</div>'; // end questiongroup

      }
			echo '</div>'; // end faq_accordion_emp
			echo '</div>'; // end large-6 column

		?>

		</div> <!-- end faq-accordion -->
	</div> <!-- end container-->

	</section> <!-- end section qa-main -->

		<div class="qa-contact">
			<?php $contact_url = network_site_url('contact/');
			echo "<h3 id='contact'>Still have questions? <a href=". $contact_url . ">Contact Us!</a></h3>";
			?>

		</div>


</div>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
  // Build accordion
	jQuery(function() {
      jQuery( ".accordion_section" ).accordion({
    	collapsible: true,
    	heightStyle: "content",
    	active: false
    });

      jQuery( ".accordion-q" ).click(function() {
      // All icons to plus
      var allIcons = jQuery(this).closest('.accordion_section').find('i');
      allIcons.removeClass('fa-minus-square').addClass('fa-plus-square');

      var thisIcon = jQuery(this).find('i');

      // If active, set the minus icon
      if(jQuery(this).hasClass('ui-state-active'))
        thisIcon.removeClass('fa-plus-square').addClass('fa-minus-square');
      else
        thisIcon.removeClass('fa-minus-square').addClass('fa-plus-square');
    });
	 });

  jQuery(document).ready(function(){
    // Swap between tabs
    jQuery('ul.tabs li').click(function(){
  		var tab_id = jQuery(this).attr('data-tab');

      jQuery('ul.tabs li').removeClass('current');
      jQuery('.tab-content').removeClass('current');

      jQuery(this).addClass('current');
      jQuery("#"+tab_id).addClass('current');
  	});

    jQuery('#ui-accordion-faq_accordion_stu-header-2').removeClass('ui-accordion-header');

    // Add 'x' to corner of search bar by making class 'clearable'
    // From http://stackoverflow.com/a/6258628, licensed under cc by-sa 3.0
    function tog(v){return v?'addClass':'removeClass';}
    jQuery(document).on('input', '.clearable', function(){
      jQuery(this)[tog(this.value)]('x');
    }).on('mousemove', '.x', function( e ){
      jQuery(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
    }).on('touchstart click', '.onX', function( ev ){
      ev.preventDefault();
      jQuery(this).removeClass('x onX').val('').change();
      search('');
    });
  });

  // When the input changes, trigger the search after 200ms
  var wto;
  jQuery('#faq-search input').on('input',function(e){
    var searchString = jQuery(this).val().toLowerCase();

    clearTimeout(wto);
    wto = setTimeout(function() {
      search(searchString);
    }, 200);
  });

  // Search and hide results
  function search(searchString) {
    var questionGroup = jQuery('.questiongroup');
    for(var j = 0; j < questionGroup.length; j++) {
      var currentGroup = jQuery(questionGroup[j]);
      var questions = currentGroup.find('h3');
      var answers = questions.next();

      questions.hide();
      answers.hide();

      var hiddenCount = 0;
      for(var i = 0; i < questions.length && i < answers.length; i++) {
        var rawQText = questions[i].innerText || questions[i].textContent;
        var rawAText = answers[i].innerText || answers[i].textContent;

        var qText = rawQText.toLowerCase();
        var aText = rawAText.toLowerCase();
        if(qText.indexOf(searchString) != -1 || aText.indexOf(searchString) != -1){
          var matchingQuestion = $(questions[i]).show();
          if(matchingQuestion.hasClass("ui-state-active"))
            jQuery(answers[i]).show();
        }
        else {
          hiddenCount++;
        }
      }
      //console.log(hiddenCount);
      if(hiddenCount == questions.length)
        currentGroup.hide();
      else {
        currentGroup.show();
      }
    }

    // Fix css to make first item always grey
    jQuery('.questiongroup:visible:even').css('background', '#e1e1e1');
    jQuery('.questiongroup:visible:odd').css('background', '#fff');
  }

</script>
