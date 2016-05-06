<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }
if (!empty($_GET['id'])) {
    $bluid = $_GET['id'];
    $blu = getBLU($bluid);
    $page = "blu_sheet";
}
else{
    $blu = getBLUList(1);
	$page = "blu";
	
	
	
}



include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
