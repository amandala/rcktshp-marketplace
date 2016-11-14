<html>
<head>

</head>

<?php
	$path=network_site_url('wp-content/themes/hirebee-child/images/rcktshp-logo-100.gif');
	echo "<img src=".$path.">";
?>

<body <?php if ( is_rtl() ) echo 'style="direction:rtl;"'; ?> >

	<?php echo $content; ?>

	<?php echo "Thanks, <br /> The RCKTSHP Marketplace Team" ?>

	<?php
	$signature = sprintf( "<br />");
	$signature .=sprintf("<table width=100%%><tr><td>");
	$signature .=sprintf("<hr style='background-color: #EF5A32; height: 1px; border: 0;'/>");
	$signature .=sprintf("<a href='mailto:hello@rcktshp.com' style='color: #574C46; text-decoration: none;'>Contact Support</a>");
	$signature .=sprintf("<a href='' style='color: #EF5A32; text-decoration: none; cursor: default; pointer-events: none;'> | </a>");
	$signature .=sprintf("<a href='projects.rcktshp.com' style='color: #574C46; text-decoration: none; '>Visit RCKTSHP</a> ");
	$signature .=sprintf("<a href='' style='color: #EF5A32; text-decoration: none; cursor: default; pointer-events: none;'> | </a>");
	$signature .=sprintf("<a href='#' style='color: #574C46; text-decoration: none;'>Terms and Conditions</a> ");
	


	$signature .=sprintf("<div style='color: #574C46;'> 119 14 Street NW, Calgary, AB T2N1Z6 © 2015 RCKTSHP</div>");
	$signature .=sprintf("</td></tr></table>");

	echo $signature;
	?>

</body>
</html>
