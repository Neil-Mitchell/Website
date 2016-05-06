<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }
if (!empty($_GET['id'])) {
    $monsterid = $_GET['id'];
    $monster = getMonster($monsterid);
    $page = "monster_sheet";
}
elseif(!isset($_POST['name'])) {
	$page = "monsters";
}
else{
	$monstername = $_POST['name'];
	$monsterid = str_replace(' ','_',$monstername);
    $monster = getMonsterList($monsterid);
	$page = "monsters";
	
	
	
}



include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
