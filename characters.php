<?php
require_once("includes/config.php");
require_once("includes/global.php");

    if (empty($users['authed'])) {
        $_SESSION['destination'] = basename($_SERVER['SCRIPT_FILENAME']);
        redirects("login.php"); // Should be changed to the login page once it's completed
    }


if (!empty($_GET['id'])) {
    $charid = $_GET['id'];
    $char = getCharacter($charid);
    $page = "character_sheet";
}
else {

  $chars = getCharacterList($users['id']);
  	$move='';
	if(empty($_GET['unstuck'])){
	$move='';
	}else{
	$move=Unstuck($_GET['unstuck'],$users['id']);
	}
  $page = "characters";
  
}

include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/$page.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;
