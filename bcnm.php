<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }
if (!empty($_GET['id'])) {
    $bcnmid = $_GET['id'];
    $BCNM = getBCNM($bcnmid);
    $page = "BCNM_sheet";
}
else{
    $BCNM = getBCNMList(0);
	$page = "BCNM";
	
	
	
}



include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
