<?php /* Template Name: contact-us */ ?>

<?php
if(isset($_POST['submit'])){
    $to = "hello@rcktshp.com";
    $from = $_POST['email']; 
    $sendername = $_POST['sendername'];
    $subject = "New RCKTSHP Contact Form Submission";
    $subject2 = "Copy of your inquiry to RCTSHP";
    $message = $sendername . " wrote the following:" . "\r\n\r\n" . $_POST['message'] .  "\r\n\r\n" ."Reply to: " . $from;
    $message2 = "Here is a copy of your message " . $sendername . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;

    if(isset($_POST['security']) && $_POST['security'] == 50){
    	rcktshp_custom_email($to,$subject,wpautop($message),$headers);

    	rcktshp_custom_email($from,$subject2,wpautop($message),$headers2); // sends a copy of the message to the sender

   		 echo "<p class='contact-message'>Mail Sent. Thank you " . $sendername . ", we will contact you shortly.</p>";
    	// You can also use header('Location: thank_you.php'); to redirect to another page.	
    }
    else {
    	echo "<div class='large-10 push-1 columns'><p class='contact-message'>We're sorry! There was a problem. Please check your answer to the security question and try again.</p></div>";
    }
}
?>


<div class='large-10 push-1 columns contact-content'>

	<div class="large-10 push-1 columns">
		<h3 class="centered">Don't be shy! Get in touch with us.</h3>
		<form action="" method="post" id="contact-form">

			<div class="large-6 columns">
				<input type="text" name="sendername" placeholder="Name"><br>
			</div>
			<div class="large-6 columns">
				<input type="text" name="email" placeholder="Email"><br>
			</div>

			<div class="large-12 columns">
				<textarea class="message-area" rows="4" name="message" cols="30" placeholder="Message"></textarea><br>
			</div>
			<div class="large-6 columns right">
				<input type="number" name="security" placeholder="What is 5 x 10?">
			</div>
			<div class=" large-12 columns contact-submit">
				<input type="submit" class="button orange" name="submit" value="Send" id="contact-form-submit">
			</div>
		</form>
	</div>
	<!--<div class="large-3 columns grey-sidebar">
		<h4>Social Media:</h4>
	</div> -->
</div>
