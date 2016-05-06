<?php

        <div class="panel-heading"><span class="glyphicon glyphicon-search"></span> Item Search</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th><form action="" method="post"><input type="text" name="name" placeholder="Enter a Item"></input>  <input type="submit" value="Search"></input></form></th>
              </tr>
            </thead>
            <tbody>';
            if (!isset($_POST['name'])) {
				
            }
			elseif(strlen($_POST['name'])<='3'){
				              $output .= '
              <tr>
                <td><em>You Must enter more than 3 characters</em></td>
              </tr>';
			}
			elseif($item=='empty'){
				              $output .= '
              <tr>
                <td><em>No Items Found</em></td>
              </tr>';
			}
			
            else{
				foreach ($item as $items) {
				 $output .= '
              <tr>
                <td><em><a href="?id='.$items['itemid'].'">'.ucfirst(str_replace('_',' ',$items['sortname'])).' </a></td>
              </tr>';
				}
            }
            $output .= '
            </tbody>
          </table>
        </div>
      </div>
$item = $item[0];


$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Item Information - '.ucwords(str_replace('_',' ',$item['sortname'])).' ('.$item['itemid'].')</em></div>
        <div class="panel-body">';
if (empty($item['itemid'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving item. Please check the Item ID and try again.</div>';
}
else {
	
			if($item['NoSale']==1){
			$sell='No';
		}else{
			$sell='Yes';
		}
		$sellprice=number_format($item['BaseSell']);
		$aH=$item['aH'];
	
$output .= '
<table class="table table-condensed">
<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#basic">Basic Information</a></td></tr><tr><td>

<div id="basic" class="collapse out">

 <table class="table table-condensed">
 <tr><td>Name:</td><td>'.ucwords(str_replace('_',' ',$item['sortname'])).'</td></tr>
<tr><td>Item ID:</td><td>'.$item['itemid'].'</td></tr>
<tr><td>Stack Size:</td><td>'.$item['stackSize'].'</td></tr>
<tr><td>Sell Price:</td><td>'.$sellprice.' Gil</td></tr>
<tr><td>Sellable:</td><td>'.$sell.'</td></tr>
<tr><td>Flags:</td><td>';
 $x=$item['flags'];
   $n = 1 ;
    while ( $x > 0 ) {
        if ( $x & 1 == 1 ) {
            $output .= ' '.$flag_array[$n].', ';
        }
        $n *= 2 ;
        $x >>= 1 ;
    }
if ($x==0){
	$output .= 'None';
}
$output .= '
</td></tr>
<tr><td>AH Category:</td><td>'.$ahcat[$aH].'</td></tr>
 
</table></div></td></tr>';

	$armors = getArmor($item['itemid']);
	
	if($armors == 'empty'){
		
	}else{

 				foreach ($armors as $armor) {
$output .= '<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#armor">Armor Information</a></td></tr><tr><td>

<div id="armor" class="collapse out">
<table class="table table-condensed">

<tr><td>Level:</td><td>'.$armor['level'].'</td></tr>
<tr><td>Jobs:</td><td>';
    $x=$armor['jobs'];
if($x==4194303){
	$output .= 'All Jobs';
}else{
    $n = 1 ;
    while ( $x > 0 ) {
        if ( $x & 1 == 1 ) {
            $output .= ' '.strtoupper($jobs_array[$n]).'';
        }
        $n *= 2 ;
        $x >>= 1 ;
    }
}

$output .= '
</td></tr>
<tr><td>Slot(s):</td><td>'.$slot_array[$armor['slot']].'</td></tr>';
	}
				$output .= '
</table></div></td></tr>';
	}
	$weapons = getWeapon($item['itemid']);
	if($weapons == 'empty'){
		
	}else{
 				foreach ($weapons as $weapon) {
$output .= '
<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#weapon">Weapon Information</a></td></tr><tr><td>

<div id="weapon" class="collapse out">
<table class="table table-condensed">

<tr><td>Skill:</td><td>'.$skills[$weapon['skill']].'</td></tr>
<tr><td>Damage Type:</td><td>'.$damage[$weapon['dmgType']].'</td></tr>
<tr><td>Hits:</td><td>'.$weapon['hit'].'</td></tr>
<tr><td>Delay:</td><td>'.$weapon['delay'].'</td></tr>
<tr><td>Damage:</td><td>'.$weapon['dmg'].'</td></tr>
<tr><td>Points to Unlock:</td><td>'.$weapon['unlock_points'].'</td></tr>';

				}
$output .= '			
</table></div></td></tr>';

	}
	$usable = getUsable($item['itemid']);
	if($usable == 'empty'){
		
	}else{
 				foreach ($usable as $use) {
$output .= '
<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#use">Usable Information</a></td></tr><tr><td>

<div id="use" class="collapse out">
<table class="table table-condensed">

<tr><td>Animation Time:</td><td>'.$use['animationTime'].'</td></tr>
<tr><td>Max Charges:</td><td>'.$use['maxCharges'].'</td></tr>
<tr><td>Use Delay:</td><td>'.$use['useDelay'].'</td></tr>
<tr><td>Reuse Delay:</td><td>'.$use['reuseDelay'].'</td></tr>';

				}
$output .= '			
</table></div></td></tr>';

	}
	$furn = getFurniture($item['itemid']);
	if($furn == 'empty'){
		
	}else{
 				foreach ($furn as $furns) {
$output .= '<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#furn">Furniture Information</a></td></tr><tr><td>

<div id="furn" class="collapse out">
<table class="table table-condensed">

<tr><td>Storage:</td><td>'.$furns['storage'].'</td></tr>
<tr><td>Moghancement:</td><td>'.$furns['moghancement'].'</td></tr>
<tr><td>Element:</td><td>'.$furns['element'].'</td></tr>
<tr><td>Aura:</td><td>'.$furns['aura'].'</td></tr>';

				}
$output .= '			
</table></div></td></tr>';

	}
	$mods = getMods($item['itemid']);
	if($mods == 'empty'){
		
	}else{
		$output .= '<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#mod">Mod Information</a></td></tr><tr><td>

<div id="mod" class="collapse out">
<table class="table table-condensed"><tr class="warning"><td>Mod Name</td><td>Value</td></tr>';

 				foreach ($mods as $mod) {
$output .= '
<tr><td>'.strtoupper(str_replace('_',' ',$mod_name[$mod['modId']])).'</td><td>'.$mod['value'].'</td></tr>';

				}
$output .= '			
</table></div></td></tr>';

	}
	$latents = getLatents($item['itemid']);
	if($latents == 'empty'){
		
	}else{
		$output .= '<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#latents">Latent Mod Information</a></td></tr><tr><td>

<div id="latents" class="collapse out">
<table class="table table-condensed"><tr class="warning"><td>Mod</td><td>Value</td><td>Latent</td><td>Latent Parameter</td></tr>';

 				foreach ($latents as $latent) {
$output .= '


<tr><td>'.strtoupper(str_replace('_',' ',$mod_name[$mod['modId']])).'</td><td>'.$latent['value'].'</td><td>'.strtoupper(str_replace('_',' ',$latent_name[$latent['latentId']])).'</td><td>'.$latent['latentParam'].'</td></tr>';

				}
$output .= '			
</table></div></td></tr>';

	}
	
	$drops = getItemDrops($item['itemid']);
	if($drops == 'empty'){
		
	}else{
		$output .= '
		<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#drop">Drop Information</a></td></tr><tr><td>

<div id="drop" class="collapse out">
<table class="table table-condensed">';

 				foreach ($drops as $drop) {
					$rate=$drop['rate']/10;
					
					if(!$drop['polutils_name']){}else{
$output .= '

<tr><td><a href="monsters.php?id='.$drop['mobid'].'">'.$drop['polutils_name'].'</a></td><td>'.getZoneName($drop['zoneid']).'</td><td>'.$rate.'%</td></tr>';

					}
				}
$output .= '			
</table></div></td></tr>';

	}
	
	
	$drops = getBCNMDrops($item['itemid']);
	if($drops == 'empty'){
		
	}else{
		$output .= '
		<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#bcnm">BCNM Information</a></td></tr><tr><td>

<div id="bcnm" class="collapse out">
		
<table class="table table-condensed"><tr class="warning"><td>BCNM</td><td>Rate</td><td>Level Cap</td></tr>';

 				foreach ($drops as $drop) {
	$rate=$drop['rolls']/10;
	$levelcap=$drop['levelCap'];
	if($levelcap==0){
	$levelcap='Uncapped';
	}
$output .= '




<tr><td><a href="BCNM.php?id='.$drop['bcnmId'].'">'.ucwords(str_replace('_',' ',$drop['name'])).'</a></td><td>'.$rate.'%</td><td>'.$levelcap.'</td></tr>';

					
				}
$output .= '			
</table></div></td></tr>';

	}
	
	
	$crafts = getCrafts($item['itemid']);
	if($crafts == 'empty'){
		
	}else{
		$output .= '
		<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#crafts">Crafting Information</a></td></tr><tr><td>

<div id="crafts" class="collapse out">
<table class="table table-condensed">';

 				foreach ($crafts as $craft) {
					
$alchemy=$craft['Alchemy'];
$bone=$craft['Bone'];
$cloth=$craft['Cloth'];
$cook=$craft['Cook'];
$gold=$craft['Gold'];
$leather=$craft['Leather'];
$smith=$craft['Smith'];
$wood=$craft['Wood'];

$a = array("Alchemy"=>$alchemy, "Bonecraft"=>$bone, "Clothcraft"=>$cloth, "Cooking"=>$cook, "Gold Smithing"=>$gold, "Leathercraft"=>$leather, "Smithing"=>$smith, "Woodworking"=>$wood,);

$output .= ' <tr class="warning"><td>';
foreach ($a as $key => $val ) {
	if($val>0){    $output .= ''.$key.' ('.$val.') ';
	}
}
$output .= '<a href="items.php?id='.$craft['Crystal'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Crystal'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Crystal']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Crystal']))).'</a></td></tr>';

if($craft['Ingredient1']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient1'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient1'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient1']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient1']))).'</a></td></tr>';
}
if($craft['Ingredient2']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient2'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient2'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient2']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient2']))).'</a></td></tr>';
}
if($craft['Ingredient3']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient3'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient3'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient3']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient3']))).'</a></td></tr>';
}
if($craft['Ingredient4']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient4'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient4'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient4']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient4']))).'</a></td></tr>';
}
if($craft['Ingredient5']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient5'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient5'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient5']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient5']))).'</a></td></tr>';
}
if($craft['Ingredient6']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient6'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient6'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient6']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient6']))).'</a></td></tr>';
}
if($craft['Ingredient7']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient7'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient7'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient7']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient7']))).'</a></td></tr>';
}
if($craft['Ingredient8']>0){
$output .= '
<tr><td>Ingredient: <a href="items.php?id='.$craft['Ingredient8'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Ingredient8'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Ingredient8']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Ingredient8']))).'</a></td></tr>';
}
$output .= '
<tr class="active"><td>Results</td></tr>
<tr><td>NQ: <a href="items.php?id='.$craft['Result'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['Result'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['Result']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['Result']))).'</a> x '.$craft['ResultQty'].'</td></tr>
<tr><td>HQ: <a href="items.php?id='.$craft['ResultHQ1'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['ResultHQ1'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['ResultHQ1']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['ResultHQ1']))).'</a> x '.$craft['ResultHQ1Qty'].'</td></tr>
<tr><td>HQ2: <a href="items.php?id='.$craft['ResultHQ2'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['ResultHQ2'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['ResultHQ2']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['ResultHQ2']))).'</a> x '.$craft['ResultHQ2Qty'].'</td></tr>
<tr><td>HQ3: <a href="items.php?id='.$craft['ResultHQ3'].'"><img src=http://static.ffxiah.com/images/icon/'.$craft['ResultHQ3'].'.png alt='.ucwords(str_replace('_',' ',getItemName($craft['ResultHQ3']))).' height=32 width=32> '.ucwords(str_replace('_',' ',getItemName($craft['ResultHQ3']))).'</a> x '.$craft['ResultHQ3Qty'].'</td></tr>

';

					
				}
$output .= '			
</table></div></td></tr>';

	}
	
	
	
	
	
		$bazaar = getBazaarItem($item['itemid']);
	if($bazaar == 'empty'){
		
	}else{
		$output .= '
		<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#baz">Bazaar Information</a></td></tr><tr><td>

<div id="baz" class="collapse out">
		
<table class="table table-condensed"><tr class="warning"><td>Character</td><td>Gil</td><td>Quantity</td></tr>';

 				foreach ($bazaar as $baz) {

			
				
$output .= '
	
<tr><td><a href="characters.php?id='.$baz['charid'].'">'.ucwords(str_replace('_',' ',$baz['charname'])).'</a></td><td>'.$baz['bazaar'].'</td><td>'.$baz['quantity'].'</td></tr>';

					
				}
$output .= '			
</table></div></td></tr>';

	}
	
	
			$AH = getAHItem($item['itemid']);
	if($AH == 'empty'){
		
	}else{
		$output .= '
		<tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#AH">Auction House History</a></td></tr><tr><td>

<div id="AH" class="collapse out">
		
<table class="table table-condensed"><tr class="warning"><td>Seller</td><td>Buyer</td><td>Quantity</td><td>Gil</td><td>Date</td></tr>';

 				foreach ($AH as $house) {
$date=date('Y/m/d', $house['sell_date']);
		$char = getCharacterName($house['seller']);		
		$chars = getCharacterByName($house['buyer_name']);
		if($house['stack']==1){
			$q=$item['stackSize'];
		}else{
			$q=1;
		}
	if($char == 'empty' or $chars== 'empty'){
		
	}else{	
				
$output .= '
	
<tr><td><a href="characters.php?id='.$house['seller'].'">'.ucwords(str_replace('_',' ',$char)).'</a></td><td><a href="characters.php?id='.$chars['charid'].'">'.ucwords(str_replace('_',' ',$house['buyer_name'])).'</a></td><td>'.$q.'</td><td>'.$house['sale'].'</td><td>'.$date.'</td></tr>';

					
				}
				}
$output .= '			
</table></div></td></tr>';

	}
	error_reporting(0);
	if(getCharacterGM($users['id'])>=4){
$var2=ucwords($item['name']);
$var3="scripts/globals/items/$var2.lua";
$myfile = fopen("$var3", "r");
if(!$myfile){
}else{
 $output .= '<tr><td><textarea rows="25" cols="100">
'.fread($myfile,filesize($var3)).' </textarea></td></tr>';
fclose($myfile);
}
}
else{
	
}
	
	$output .= '
</table>

';

            
$output .= '
';


}
$output .= '
        </div>
      </div>
    </div>
	</div>
  </body>';