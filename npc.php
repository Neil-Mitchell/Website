<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }
if (!empty($_GET['id'])) {
    $npcid = $_GET['id'];
    $npc = getNPC($npcid);
    $page = "npc_sheet";
}
elseif(!isset($_POST['name'])) {
	$page = "npc";
}
else{
	$npcname = $_POST['name'];
	$npcid = str_replace(' ','_',$npcname);
    $npc = getNPCList($npcid);
	$page = "npc";
	
	
	
}



include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
