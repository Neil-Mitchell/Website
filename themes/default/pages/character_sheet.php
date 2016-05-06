<?php

$char = $char[0];

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Character Sheet </em></div>
        <div class="panel-body">';
if (empty($char['charid'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving character. Please check the Character ID and try again.</div>';
}
else {
	if($char['nation']==0){
		$bgcolor="#FF7777";
		$nation="San d'Oria";
		$rank=$char['rank_sandoria'];
	}
	elseif($char['nation']==1){
		$bgcolor="#777BFF";
		$nation="Bastok";
		$rank=$char['rank_bastok'];
	}
	elseif($char['nation']==2){
		$bgcolor="#FDFF77";
		$nation="Windurst";
		$rank=$char['rank_windurst'];
	}
	else{
		$rank='N/A';
	}
	
$main=0;
$sub=1;
$ranged=2;
$ammo=3;
$head=4;
$body=5;
$hands=6;
$legs=7;
$feet=8;
$neck=9;
$waist=10;
$ear1=11;
$ear2=12;
$ring1=13;
$ring2=14;
$back=15;
		  		  if(getCharacterGM($users['id'])>=1){
$output .= '<table class="table table-condensed"><tr class="success"><td><strong><a style="cursor: pointer;" data-toggle="collapse" data-target="#gm">GM Information</a></td></tr><tr><td>

<div id="gm" class="collapse out"><table class="table table-condensed">';
		  
		  		  if(getCharacterGM($users['id'])>=4){
			  $output .= '
			  <tr><td>Login:</td><td colspan=3>'.$char['login'].'';
		  }
		  
			$output .= '
			  <tr><td>Account ID:</td><td colspan=3>'.$char['accid'].'</td></tr>
			  <tr><td>Created:</td><td colspan=3>'.$char['timecreate'].'</td></tr>
			  <tr><td>Last Login:</td><td colspan=3>'.$char['timelastmodify'].'</td></tr>';
			   if(getCharacterGM($users['id'])>=2){
			  $output .= '
			  <tr><td>GM Level:</td><td colspan=3>'.$char['gmlevel'].'</td></tr>';
		  }
				 $output .= '</table></div></table>'; }

  $output .= '<table class="table table-condensed"><tr class=active><td><table class="table table-condensed"><tr><td rowspan="3">
          <img src="themes/'.$config['theme'].'/pages/images/chars/'.$char['race'].'/'.$char['face'].'.jpg" height="100" width="100" alt="Character Model" title="Character Model"></td><td><strong>'.$char['charname'].'</strong></td><td></td><td></td></tr>
          <tr style="background-color:'.$bgcolor.';"><td colspan="3"><img src="themes/'.$config['theme'].'/pages/images/'.$char['nation'].'.jpg" alt="'.$nation.'" title="'.$nation.'" width="20" height="20"> <strong>'.$nation.' '.$rank.' - '.ucfirst(str_replace('_',' ',strtolower($real_title[$char['title']]))).'</strong></td></tr>
          <tr><td colspan="3">'.$char['mlvl'].strtoupper($jobs[$char['mjob']]).(!empty($char['sjob']) ? '/'.$char['slvl'].strtoupper($jobs[$char['sjob']]) : '').'</td></tr>';

		  $output .= '</table></td></tr><tr class=active><td><table class="table table-condensed">
		  <tr class="success"><td><strong>Missions</td><td><strong>Crafts</td><td><strong>Jobs</td><td><strong>Equipment</td></tr>
		  <tr>
		  <td>
		  <table class="table table-condensed">
		  <tr><td style="background-color:#FF7777;" width=33%><img src="themes/'.$config['theme'].'/pages/images/0.jpg" alt="San dOria" title="San dOria" width="20" height="20"> <strong>'.$char['rank_sandoria'].'</td><td style="background-color:#777BFF;" width=33%><img src="themes/'.$config['theme'].'/pages/images/1.jpg" alt="Bastok" title="Bastok" width="20" height="20"> <strong>'.$char['rank_bastok'].'</td><td style="background-color:#FDFF77;" width=33%><img src="themes/'.$config['theme'].'/pages/images/2.jpg" alt="Windurst" title="Windurst" width="20" height="20"> <strong>'.$char['rank_windurst'].'</td></tr>';

		  
	error_reporting(0);
		  
		  
    $kid = unpack('C*', $char['missions']);
	$kida = array_merge($kid, $mission_array);
	
	foreach($kid as $key=>$value){ 
	$status="<font color=orange>$value</font>";
	if($value==1 && $key !=1 && $key !=67 && $key !=133 && $key !=199 && $key !=265 && $key !=331 && $key !=397 && $key !=595 && $key !=661 && $key !=727 && $key !=793){
	$status="<font color=green>Complete</font>";
	}
	if($value>0 && $key ==1 || $value>0 && $key ==67 || $value>0 && $key ==133 || $value>0 && $key ==199 || $value>0 && $key ==265 || $value>0 && $key ==331 || $value>0 && $key ==397 || $value>0 && $key ==595 || $value>0 && $key ==661 || $value>0 && $key ==727 || $value>0 && $key ==793){
	$newvalue=$key+2+$value;
	$status=$mission_array[$newvalue];
	$status=str_replace('_',' ',$status);
	}
	if($value==255){
	$status="<font color=orange>No Current Mission</font>";
	}
	if($value==0 && $key !=1 && $key !=67 && $key !=133 && $key !=199 && $key !=265 && $key !=331 && $key !=397 && $key !=595 && $key !=661 && $key !=727 && $key !=793){
	$status="<font color=red>Unavailable or Skipped</font>";
	}
		if($value==0 && $key ==1 || $value==0 && $key ==67 || $value==0 && $key ==133 || $value==0 && $key ==199 || $value==0 && $key ==265 || $value==0 && $key ==331 || $value==0 && $key ==397 || $value==0 && $key ==595 || $value==0 && $key ==661 || $value==0 && $key ==727 || $value==0 && $key ==793){
	$status="<font color=orange>No Current Mission</font>";
	}

if(!$mission_array[$key] or $key>=495 or $key==9 or $key==10 or $key==11 or $key==12 or $key==75 or $key==76 or $key==77 or $key==78 or $key==141 or $key==142 or $key==143 or $key==144){
}else{
	if($key==1){
	$output .= '<tr><td>'.$mission_array[$key].'</td><td colspan=2]>'.$status.'</td></tr>';
	}
	if($key==67){
	$output .= '<tr><td>'.$mission_array[$key].'</td><td colspan=2>'.$status.'</td></tr>';
	}
	if($key==133){
	$output .= '<tr><td>'.$mission_array[$key].'</td><td colspan=2>'.$status.'</td></tr>';
	}
	if($key==199){
	$output .= '<tr><td>'.$mission_array[$key].'</td><td colspan=2>'.$status.'</td></tr>';
	}
	if($key==265){
	$output .= '<tr><td>'.$mission_array[$key].'</td><td colspan=2>'.$status.'</td></tr>';
	}
	if($key==397){
	$output .= '<tr><td>'.$mission_array[$key].'</td><td colspan=2>'.$status.'</td></tr>';
	}
	}
	}	

		  
		  $output .='</table>
		  </td>
		  <td><table class="table table-condensed">
		  
		  <tr><td>Fishing</td><td>'.getSkill($char['charid'],48).'</td></tr>
<tr><td>Wood Working</td><td>'.getSkill($char['charid'],49).'</td></tr>
<tr><td>Smithing</td><td>'.getSkill($char['charid'],50).'</td></tr>
<tr><td>Gold Smithing</td><td>'.getSkill($char['charid'],51).'</td></tr>
<tr><td>Cloth Craft</td><td>'.getSkill($char['charid'],52).'</td></tr>
<tr><td>Leather Craft</td><td>'.getSkill($char['charid'],53).'</td></tr>
<tr><td>Bone Craft</td><td>'.getSkill($char['charid'],54).'</td></tr>
<tr><td>Alchemy</td><td>'.getSkill($char['charid'],55).'</td></tr>
<tr><td>Cooking</td><td>'.getSkill($char['charid'],56).'</td></tr>
		  </table>
		  </td>
		  <td><table class="table table-condensed">
<tr><td>WAR</td><td>'.$char['war'].'</td><td>MNK</td><td>'.$char['mnk'].'</td></tr>
<tr><td>WHM</td><td>'.$char['whm'].'</td><td>BLM</td><td>'.$char['blm'].'</td></tr>
<tr><td>RDM</td><td>'.$char['rdm'].'</td><td>THF</td><td>'.$char['thf'].'</td></tr>
<tr><td>PLD</td><td>'.$char['pld'].'</td><td>DRK</td><td>'.$char['drk'].'</td></tr>
<tr><td>BST</td><td>'.$char['bst'].'</td><td>BRD</td><td>'.$char['brd'].'</td></tr>
<tr><td>RNG</td><td>'.$char['rng'].'</td><td>SAM</td><td>'.$char['sam'].'</td></tr>
<tr><td>NIN</td><td>'.$char['nin'].'</td><td>DRG</td><td>'.$char['drg'].'</td></tr>
<tr><td>SMN</td><td>'.$char['smn'].'</td><td>BLU</td><td>'.$char['blu'].'</td></tr>
<tr><td>COR</td><td>'.$char['cor'].'</td><td>PUP</td><td>'.$char['pup'].'</td></tr>
<tr><td>SCH</td><td>'.$char['sch'].'</td><td>DNC</td><td>'.$char['dnc'].'</td></tr>
<tr><td>GEO</td><td>'.$char['geo'].'</td><td>RUN</td><td>'.$char['run'].'</td></tr>
		  </table>
		  </td>
		  <td>
		  <table width=100% border=1>
<tr><td><center>
'.equip_to_item($charid,$main).'
</td><td><center>
'.equip_to_item($charid,$sub).'
</td><td><center>
'.equip_to_item($charid,$ranged).'
</td><td><center>
'.equip_to_item($charid,$ammo).'
</td></tr>
<tr><td><center>
'.equip_to_item($charid,$head).'
</td><td><center>
'.equip_to_item($charid,$neck).'
</td><td><center>
'.equip_to_item($charid,$ear1).'
</td><td><center>
'.equip_to_item($charid,$ear2).'
</td></tr>
<tr><td><center>
'.equip_to_item($charid,$body).'
</td><td><center>
'.equip_to_item($charid,$hands).'
</td><td><center>
'.equip_to_item($charid,$ring1).'
</td><td><center>
'.equip_to_item($charid,$ring2).'
</td></tr>
<tr><td><center>
'.equip_to_item($charid,$back).'
</td><td><center>
'.equip_to_item($charid,$waist).'
</td><td><center>
'.equip_to_item($charid,$legs).'
</td><td><center>
'.equip_to_item($charid,$feet).'
</td></tr>
</table>
		  </td>
		  </tr></table></td></tr><tr class=active><td><table class="table table-condensed">
		  
		  <tr class=success><td colspan=5><strong>Auction House History</strong></td></tr>
		  <tr class=active><td>Item</td><td>Seller</td><td>Buyer</td><td>Gil</td><td>Date</td></tr>
		  ';
		  $AH = getAHPlayer($char['charid'],$char['charname']);
		  if($AH=='empty'){
			  $output .= '<tr><td colspan=5>No Auction House History </td></tr>';
		  }else{
		  foreach ($AH as $house) {
$date=date('Y/m/d', $house['sell_date']);
		$chared = getCharacterName($house['seller']);		
		$chars = getCharacterByName($house['buyer_name']);
		$item = getItems($house['itemid']);
		if($house['stack']==1){
			$q=$item['stackSize'];
		}else{
			$q=1;
		}
	if($char == 'empty' or $chars== 'empty' or $item== 'empty'){
		
	}else{	
				
$output .= '
	
<tr><td><a href="items.php?id='.$house['itemid'].'"><img src=http://static.ffxiah.com/images/icon/'.$house['itemid'].'.png alt='.ucwords(str_replace('_',' ',$item['sortname'])).' height=32 width=32> '.ucwords(str_replace('_',' ',$item['sortname'])).'</a></td><td><a href="characters.php?id='.$house['seller'].'">'.ucwords(str_replace('_',' ',$chared)).'</a></td><td><a href="characters.php?id='.$chars['charid'].'">'.ucwords(str_replace('_',' ',$house['buyer_name'])).'</a></td><td>'.$house['sale'].'</td><td>'.$date.'</td></tr>';

					
				}
				}
		  }
		  
		  $output .= '
		  </table></td></tr><tr class=active><td><table class="table table-condensed">
		  
		  <tr class=success><td colspan=3><strong>Bazaar</strong></td></tr>
		  <tr class=active><td>Item</td><td>Price</td><td>Quantity</td></tr>
		  ';
		  
		  $bazaar = getBazaarPlayer($char['charid']);
		  if($bazaar == 'empty'){
		$output .= '<tr><td colspan=3>No items in Bazaar</td></tr>';
	}else{
 				foreach ($bazaar as $baz) 
				{
					
		$item = getItems($baz['itemId']);
	if($baz == 'empty' or $item == 'empty'){
		
	}else{
			
				
$output .= '
	
<tr><td><a href="items.php?id='.$item['itemid'].'">'.ucwords(str_replace('_',' ',$item['sortname'])).'</a></td><td>'.$baz['bazaar'].'</td><td>'.$baz['quantity'].'</td></tr>';

					
				}
				}
	}
		  
		  
		  $output .= '
		  </table></td></tr></table>
          ';
}
$output .= '
        </div>
      </div>
    </div>
	</div>
  </body>';