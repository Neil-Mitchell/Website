<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }
if (!empty($_GET['id'])) {
    $itemid = $_GET['id'];
    $item = getItem($itemid);
    $page = "item_sheet";
	
	$itemname = $_POST['name'];
	$itemids = str_replace(' ','_',$itemname);
    $items = getItemList($itemids);
}
elseif(!isset($_POST['name'])) {
	$page = "items";
}
else{
	$itemname = $_POST['name'];
	$itemid = str_replace(' ','_',$itemname);
    $item = getItemList($itemid);
	$page = "items";
	
	
	
}



include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
