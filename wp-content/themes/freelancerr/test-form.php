<?php
/*
 * Template Name: Test Form
 */
?>


<?php
    if(isset($_POST['email'])){
        echo 'You should recieve an email at ' . $_POST['email'];
        wp_mail($_POST['email'], $_POST['text'], 'TEST');
    }

?>

<form method="post" action="" id="contact">
    <input type="email" id="email" name="email" />
    <input type="text" id="text" name="text" />
    <input type="submit">
</form>

if(isset($_POST['email'])){
echo 'You should recieve an email at ' . $_POST['email'];
mail($_POST['email'], $_POST['text'], 'TEST');
}