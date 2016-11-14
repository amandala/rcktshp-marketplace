<?php /* Template Name: faq */ ?>




    <section id="qa-main">

   	<div class="container">

	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1"><h2 id="q-header">For Freelancers</h2></li>
		<li class="tab-link" data-tab="tab-2"><h2 id="q-header">For Employers</h2></li>
	</ul>


		<div id="faq-accordion" class="large-10 columns">

	      <?php
			$url = network_site_url('wp-content/themes/hirebee-child/faq.json');

			$string = file_get_contents($url);

			$questions = json_decode($string, true);

			echo '<div id="tab-1" class="tab-content current">';

			echo '<div class="large-12 column">';

			echo '<div id="faq_accordion_stu">';

			foreach ($questions['student'] as $value) {
				foreach ($value as  $v) {
					echo '<h3 class="accordion-q chevron_up">';
					echo $v['q'];
					echo '</h3>';
					echo '<div><p class="accordion-a">';

					echo $v['a'];

					if($v["bullets"]){

						echo "<ul>";
						foreach ($v["bullets"] as $bullet) {
							echo "<li>" . $bullet['b'] . "</li>";
						}
						echo "</ul>";
					}

					echo '</p></div>'; // end accordion-a

				}
			}

			echo '</div>'; // end faq_accordion_stu
			echo '</div>'; // end large-6 column
			echo '</div>'; // end tab-1


			echo '<div id="tab-2" class="tab-content">';
			echo '<div class="large-12 column">';

			echo '<div id="faq_accordion_emp">';

			foreach ($questions['employer'] as $value) {
				foreach ($value as  $v) {
					echo '<h3 class="accordion-q chevron_up">';
					echo $v['q'];
					echo '</h3>';
					echo '<div ><p class="accordion-a">';

					echo $v['a'];

					if($v["bullets"]){

						echo "<ul>";
						foreach ($v["bullets"] as $bullet) {
							echo "<li>" . $bullet['b'] . "</li>";
						}
						echo "</ul>";
					}

					echo '</p></div>'; // end accordion-a

				}
			}

			echo '</div>'; // end faq_accordion_emp
			echo '</div>'; // end large-6 column

		?>

		</div> <!-- end faq-accordion -->
	</div> <!-- end container-->

	</section> <!-- end section qa-main -->

		<div class="qa-contact">
			<?php $contact_url = network_site_url('contact-3/');
			echo "<h3 id='contact'>Still have questions? <a href=". $contact_url . ">Contact Us!</a></h3>";
			?>

		</div>


</div>


<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
	$(function() {
	    $( "#faq_accordion_stu" ).accordion({
	    	collapsible: true,
	    	heightStyle: "content",
	    	active: false

	    });
	 });

    $(function() {
        $( "#faq_accordion_emp" ).accordion({
        	collapsible: true,
        	heightStyle: "content",
        	active: false
        });
    });

	$( ".accordion-q" ).click(function() {
	  	$(this).toggleClass('chevron_up chevron_down');
	  	$(".accordion-q").not(this).removeClass('chevron_down').addClass('chevron_up');
	});

	$(document).ready(function(){

	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});

	$('#ui-accordion-faq_accordion_stu-header-2').removeClass('ui-accordion-header');

});
</script>
