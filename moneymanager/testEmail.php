<?php
	include("code/tools.php");
	$tools = new Tools();
	$tools->sendWelcomeEmail("kennethdeantennant@gmail.com", "John Doe");
	$tools->sendUpdateEmail("kennethdeantennant@gmail.com", "John Smith");
?>