<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
function getCharacterName($charid) {
  global $dbconn;
  
  $strSQL = "SELECT charname FROM chars WHERE charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return '';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0]['charname'];
    }
  }
}

function getCharacterByName($charname) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars WHERE charname=:charname";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charname',$charname);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return '';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0];
    }
  }
}

function getCharacter($charid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars LEFT JOIN char_stats ON chars.charid=char_stats.charid LEFT JOIN char_jobs ON chars.charid=char_jobs.charid LEFT JOIN char_look ON chars.charid=char_look.charid LEFT JOIN char_profile ON chars.charid=char_profile.charid LEFT JOIN accounts ON chars.accid=accounts.id WHERE chars.charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getCharacterSkills($charid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM char_skills WHERE charid=:charid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}
 
function getCharacterList($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM chars JOIN char_stats ON chars.charid=char_stats.charid JOIN char_jobs ON chars.charid=char_jobs.charid WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getCharacterGM($accid) {
  global $dbconn;
  
  $strSQL = "SELECT gmlevel FROM chars WHERE accid=:accid order by gmlevel desc";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    return 'Error retrieving GM Level';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'Error retrieving GM Level';
    }
    else {
      return str_replace('_',' ',$arrReturn[0]['gmlevel']);
    }
  } 
}


/*
 * redirect($page): Redirect the visitor to $page, taking into account PROTOCOL and BASE_PATH
 */
function redirects($page) {
    header("Location:". PROTOCOL . BASE_PATH . "$page");
}

function checkUsername($username) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE login=:login";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':login',$username);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }    
}

function authenticate($username) {
  global $dbconn;
    
  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR email = :username)";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':username',$username);
  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }
  if (!empty($arrReturn)) {
    $users['id'] = $arrReturn[0]['id'];
  }
  else {
    $users['id'] = 0;
  }
   
  $users['authed'] = TRUE;
  return $users;
}

function doLogin($username,$password) {
   global $dbconn;
   
  $strSQL = "SELECT * FROM accounts WHERE (login = :username OR email = :username) AND password = PASSWORD(:password)";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':username',$_POST['username']);
  $statement->bindValue(':password',$_POST['password']);
  if (!$statement->execute()) { 
    watchdog($statement->errorInfo(),'SQL'); 
  }
  else {
    $arrReturn = $statement->fetchAll(); 
  }
  if (!empty($arrReturn)) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

function getZoneName($zoneid) {
  global $dbconn;
  
  $strSQL = "SELECT name FROM zone_settings WHERE zoneid=:zoneid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':zoneid',$zoneid);
  
  if (!$statement->execute()) {
    return 'Error retrieving zone name';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'Error retrieving zone name';
    }
    else {
      return str_replace('_',' ',$arrReturn[0]['name']);
    }
  } 
}

function isOnline($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts_sessions WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return FALSE;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
}

function getAccount($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts WHERE id=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0]['login'];
    }
  }
}

function getOnlineCharacterID($accid) {
  global $dbconn;
  
  $strSQL = "SELECT * FROM accounts_sessions WHERE accid=:accid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':accid',$accid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return NULL;
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return NULL;
    }
    else {
      return $arrReturn[0]['charid'];
    }
  }
}


function getMonsterList($monsterid) {
  global $dbconn;

  $strSQL = "SELECT * from mob_spawn_points JOIN mob_groups ON mob_spawn_points.groupid=mob_groups.groupid where mobname like :mobname";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':mobname', '%' . $monsterid . '%');
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}


function getMonster($monsterid) {
  global $dbconn;
  
  $strSQL = "SELECT a.*, b.*,c.*,d.name as zonename, e.*, f.HP as gHP from mob_spawn_points a INNER JOIN mob_groups b ON a.groupid=b.groupid INNER JOIN mob_pools c ON b.poolid=c.poolid INNER JOIN zone_settings d ON b.zoneid=d.zoneid INNER JOIN mob_family_system e ON c.familyid=e.familyid INNER JOIN mob_groups f ON b.groupid=f.groupid where a.mobid=:mob";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':mob',$monsterid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getDrops($dropid) {
  global $dbconn;
  
  $strSQL = "SELECT a.*,b.* from mob_droplist a INNER JOIN item_basic b on a.itemId=b.itemid where dropId=:dropid and type='0'";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':dropid',$dropid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getItemList($itemid) {
  global $dbconn;

  $strSQL = "SELECT * from item_basic where name like :itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid', '%' . $itemid . '%');
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}


function getItem($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_basic where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getItems($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_basic where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0];
    }
  }
}

function getItemName($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT sortname from item_basic where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    return 'Error retrieving item name';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'Error retrieving item name';
    }
    else {
      return str_replace('_',' ',$arrReturn[0]['sortname']);
    }
  } 
}

function getArmor($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_armor where itemId=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getWeapon($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_weapon where itemId=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getUsable($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_usable where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getFurniture($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_furnishing where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getMods($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_mods where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getLatents($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from item_latents where itemid=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBazaarItem($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT a.*, b.* from char_inventory a LEFT JOIN chars b on a.charid=b.charid where itemid=:itemid and bazaar>0 order by bazaar desc";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBazaarPlayer($charid) {
  global $dbconn;
  
  $strSQL = "SELECT * from char_inventory where charid=:charid and bazaar>0 order by bazaar desc";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getAHItem($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from auction_house where itemid=:itemid and sale>0 order by sell_date desc limit 15";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getAHPlayer($charid,$charname) {
  global $dbconn;
  
  $strSQL = "SELECT * from auction_house where (seller=:charid or buyer_name=:charname) and sale>0 order by sell_date desc limit 15";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  $statement->bindValue(':charname',$charname);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getItemDrops($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from mob_droplist LEFT JOIN mob_groups on mob_droplist.dropId=mob_groups.dropid LEFT JOIN mob_spawn_points on mob_groups.groupid=mob_spawn_points.groupid where mob_droplist.itemId=:itemid and mob_droplist.type='0'";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBCNMDrops($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from bcnm_loot LEFT JOIN bcnm_info on bcnm_loot.LootDropId=bcnm_info.LootDropId where bcnm_loot.itemId=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getCrafts($itemid) {
  global $dbconn;
  
  $strSQL = "SELECT * from synth_recipes where Ingredient1=:itemid or Ingredient2=:itemid or Ingredient3=:itemid or Ingredient4=:itemid or Ingredient5=:itemid or Ingredient6=:itemid or Ingredient7=:itemid or Ingredient8=:itemid or Result=:itemid or ResultHQ1=:itemid or ResultHQ2=:itemid or ResultHQ3=:itemid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':itemid',$itemid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}



function getOnlineList($online) {
  global $dbconn;
  
  $strSQL = "SELECT a.*, b.*, c.*, d.* from accounts_sessions a LEFT JOIN chars b ON a.charid = b.charid LEFT JOIN char_stats c ON b.charid=c.charid LEFT JOIN char_jobs d ON b.charid=d.charid where a.charid>:online ORDER BY b.charname";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':online',$online);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getLinkshell($linkshell) {
  global $dbconn;
  
  $strSQL = "SELECT * from linkshells where linkshellid=:linkshell";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':linkshell',$linkshell);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn[0];
    }
  }
}

function hex2rgb($hex) {
	$hex = substr($hex, 1);
	$r=0;
	$g=0;
	$b=0;
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,2,1).substr($hex,2,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,0,1).substr($hex,0,1));
   }
   $rgb = array($r, $g, $b);

   return $rgb;
}

function getSkill($charid,$skill) {
  global $dbconn;
  
  $strSQL = "SELECT * from char_skills where charid=:charid and skillid=:skill";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  $statement->bindValue(':skill',$skill);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return '0';
    }
    else {
      return $arrReturn[0]['value']/10;
    }
  }
}

function equip_to_item($id,$piece)
    {
	$db1 = mysqli_connect("localhost","root","Wehavetochangethispassword2","dspdb");
$db2 = mysqli_connect("localhost","root","Wehavetochangethispassword2","eraforums");


$gear= "SELECT * from char_equip where charid='$id' and equipslotid='$piece'"  or die("Error in the consult.." . mysqli_error($db1)); 
$gear1 = $db1->query($gear) or die("Error " . mysqli_error($db1));
$gear2 = mysqli_fetch_array($gear1);

$slotid=$gear2['slotid'];
$containerid=$gear2['containerid'];

if($slotid==0){
	$img=1;
	if($piece==0){
	$img=1;
	}
	elseif($piece==1){
	$img=2;
	}
	elseif($piece==2){
	$img=3;
	}
	elseif($piece==3){
	$img=4;
	}
	elseif($piece==4){
	$img=5;
	}	
	elseif($piece==5){
	$img=9;
	}
	elseif($piece==6){
	$img=10;
	}
	elseif($piece==7){
	$img=15;
	}
	elseif($piece==8){
	$img=16;
	}
	elseif($piece==9){
	$img=6;
	}
	elseif($piece==10){
	$img=14;
	}
	elseif($piece==11){
	$img=7;
	}
	elseif($piece==12){
	$img=8;
	}
	elseif($piece==13){
	$img=11;
	}
	elseif($piece==14){
	$img=12;
	}
	elseif($piece==15){
	$img=13;
	}
	
	
	
return "<img src='http://static.ffxiah.com/images/eq$img.gif'></img>";
}else{

$slot= "SELECT * from char_inventory where charid='$id' and slot='$slotid' and location='$containerid'"  or die("Error in the consult.." . mysqli_error($db1)); 
$slot1 = $db1->query($slot) or die("Error " . mysqli_error($db1));
$slot2 = mysqli_fetch_array($slot1);
$item=$slot2['itemId'];

$items= "SELECT * from item_basic where itemid='$item'"  or die("Error in the consult.." . mysqli_error($db1)); 
$items1 = $db1->query($items) or die("Error " . mysqli_error($db1));
$items2 = mysqli_fetch_array($items1);

$armor= "SELECT * from item_armor where itemid='$item'"  or die("Error in the consult.." . mysqli_error($db1)); 
$armor1 = $db1->query($armor) or die("Error " . mysqli_error($db1));
$armor2 = mysqli_fetch_array($armor1);


$level=$armor2['level'];

$itemname=str_replace('_',' ',$items2['sortname']);
$itemname=ucwords($itemname);

return "<div id=equip><a href='items.php?id=$item'><img src=http://static.ffxiah.com/images/icon/$item.png alt='$itemname' height=32 width=32></img></a></div>";

}
    }
	
	
	
	
function getNPCList($npcid) {
  global $dbconn;
  
  $strSQL = "SELECT * from npc_list where name like :npcid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':npcid', '%' . $npcid . '%');
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}


function getNPC($npcid) {
  global $dbconn;
  
  $strSQL = "SELECT * from npc_list where npcid=:npcid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':npcid',$npcid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}


function getBLUList($bluid) {
  global $dbconn;
  
  $strSQL = "SELECT * from blue_spell_list LEFT JOIN spell_list on blue_spell_list.spellid=spell_list.spellid where blue_spell_list.spellid>=:bluid order by spell_list.name ";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':bluid',$bluid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}


function getBLU($bluid) {
  global $dbconn;
  
  $strSQL = "SELECT * from blue_spell_list LEFT JOIN spell_list on blue_spell_list.spellid=spell_list.spellid where blue_spell_list.spellid=:bluid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':bluid',$bluid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBCNMList($bcnmid) {
  global $dbconn;
  
  $strSQL = "SELECT * from bcnm_info where bcnmId>=:bcnmid order by name";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':bcnmid',$bcnmid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBCNM($bcnmid) {
  global $dbconn;
  
  $strSQL = "SELECT * from bcnm_info where bcnmId=:bcnmid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':bcnmid',$bcnmid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBCNMInfo($bcnmid) {
  global $dbconn;
  
  $strSQL = "SELECT * from bcnm_battlefield where bcnmId=:bcnmid";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':bcnmid',$bcnmid);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}
function getBCNMLoot($lootDropId) {
  global $dbconn;
  
  $strSQL = "SELECT * from bcnm_loot left join item_basic on bcnm_loot.itemId=item_basic.itemid where LootDropId=:lootDropId";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':lootDropId',$lootDropId);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function Unstuck($charid,$accid) {
  global $dbconn;
  
  $strSQL = "UPDATE chars SET pos_zone='243', pos_rot='66', pos_x='0', pos_y='3', pos_z='116' where (charid=:charid and accid=:accid and pos_zone<>'131')";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':charid',$charid);
  $statement->bindValue(':accid',$accid);
  
 if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'Error';
  }
  else {
    return 'Moved';
  }
}

function getNamesList($name) {
  global $dbconn;
  
  $strSQL = "SELECT * from chars where charname like :name";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':name', '%' . $name . '%');
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBLUskill($name) {
  global $dbconn;
  
  $strSQL = "SELECT * from mob_skills left join mob_skill_lists on mob_skills.mob_skill_id=mob_skill_lists.mob_skill_id where mob_skill_name=:name";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':name',$name);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBLUMobs($id) {
  global $dbconn;
  
  $strSQL = "SELECT * from mob_pools left join mob_groups on mob_pools.poolid=mob_groups.poolid where skill_list_id=:id";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':id',$id);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}

function getBLUSpawn($id) {
  global $dbconn;
  
  $strSQL = "SELECT * from mob_groups LEFT JOIN mob_spawn_points on mob_groups.groupid=mob_spawn_points.groupid where mob_groups.groupid=:id";
  $statement = $dbconn->prepare($strSQL);
  $statement->bindValue(':id',$id);
  
  if (!$statement->execute()) {
    watchdog($statement->errorInfo(),'SQL');
    return 'error';
  }
  else {
    $arrReturn = $statement->fetchAll();
    
    if (empty($arrReturn)) {
      return 'empty';
    }
    else {
      return $arrReturn;
    }
  }
}


      function create_where_clause($gen_id)
    {
        global $db, $auth;
        $size_gen_id = sizeof($gen_id);
        $type = 'forum_id';
        $out_where = '';
        $auth_f_read = array_keys( $auth->acl_getf( 'f_read', true ) );
        
        for ($i = 0; $i < $size_gen_id; $i++)
        {
            $id_check = (int)$gen_id[$i];
            $out_where .= ($j == 0) ? 'WHERE ' . $type . ' = ' . $id_check . ' ' : 'OR ' . $type . ' = ' . $id_check . ' ';
            $j++;
        }
        
        return $out_where;
    }
	
		function trim_news_post($text, $post_row)
	{
	    $text_limit = 500;

        // Build topic text..
        $post_text = nl2br( $text );
        $bbcode = new bbcode( base64_encode( $bbcode_bitfield ) );
        $bbcode->bbcode_second_pass( $post_text, $post_row[ 'bbcode_uid' ], $post_row[ 'bbcode_bitfield' ] );
        $post_text = smiley_text( $post_text );
        		
        //if (utf8_strlen( $post_text ) > $text_limit)
        //{
        //    $post_text = utf8_substr( $post_text, 0, $text_limit ) . "...<br><br>";
        //    $post_text .= "<a href='{$topic_link}'>[Continue Reading..]</a>";
        //}
		
		return $post_text;
	}

