<?php

$BCNM = $BCNM[0];

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> BCNM Sheet </em></div>
        <div class="panel-body">';
if (empty($BCNM['bcnmId'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving BCNM. Please check the BCNM ID and try again.</div>';
}
else {
			

	  $output .= '

 <table class="table table-condensed"><tr class="success"><td colspan=2><center><strong>'.ucwords(str_replace('_',' ',$BCNM['name'])).'</strong></center></td></tr>
 <tr><td>Zone:</td><td>'.getZoneName($BCNM['zoneId']).'</td></tr>
 <tr><td>Level Cap:</td><td>'.$BCNM['levelCap'].'</td></tr>
 <tr><td>Time Limit:</td><td>'.($BCNM['timeLimit']/60).' Minutes</td></tr>
 <tr><td>Party Size:</td><td>'.$BCNM['partySize'].'</td></tr>
  <tr><td>Rules:</td><td>';
     $x=$BCNM['rules'];
    $n = 1 ;
    while ( $x > 0 ) {
        if ( $x & 1 == 1 ) {
            $output .= ' '.ucwords($rules_array[$n]).'';
        }
        $n *= 2 ;
        $x >>= 1 ;
    }
 $output .= ' </td>

 ';
  $output .= ' <tr class="success"><td colspan=2>Battlefield Info</td></tr>
<tr class=active><td>Battfield Number</td><td>Monster</td></tr>
 ';
 	$info = getBCNMInfo($BCNM['bcnmId']);
	if($info == 'empty'){
		
	}else{
 				foreach ($info as $infos) {
$output .= '


<tr><td>'.$infos['battlefieldNumber'].'</td><td><a href="monsters.php?id='.$infos['monsterId'].'">'.getMonster($infos['monsterId'])[0]['polutils_name'].'</a></td></tr>
';

				}

	}
 
 
  $output .= ' <tr class="success"><td colspan=2>Loot Info</td></tr>
<tr class=active><td>Item</td><td>Rate</td></tr>
 ';
 
  	$loot = getBCNMLoot($BCNM['lootDropId']);
	if($loot == 'empty'){
		
	}else{
 				foreach ($loot as $loots) {
$output .= '


<tr><td><a href="items.php?id='.$loots['itemId'].'">'.ucwords(str_replace('_',' ',$loots['sortname'])).'</a></td><td>'.($loots['rolls']/10).'%</td></tr>
';

				}

	}

}
$output .= '</td></tr></table>
        </div>
      </div>
    </div>
	</div>
  </body>';