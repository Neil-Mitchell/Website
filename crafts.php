<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }
if (!empty($_GET['id'])) {
    $craftid = $_GET['id'];
    $craft = getCraft($craftid);
    $page = "craft_sheet";
}
elseif(!isset($_GET['name'])) {
	$page = "craft";
}
else{
	$craftname = $_GET['name'];
	$craftid = str_replace(' ','_',$craftname);
    $craft = getCraftList($craftid);
	$page = "craft";
	
	
	
}



include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
