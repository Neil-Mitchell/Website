<?php

$monster = $monster[0];


$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Monster Information</em></div>
        <div class="panel-body">';
if (empty($monster['mobid'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving monster. Please check the Monster ID and try again.</div>';
}
else {
	
$output .= '

 <table class="table table-condensed"><tr class="success"><td colspan=2><center><strong>'.$monster['polutils_name'].'</strong></center></td></tr>
 <tr><td>Zone:</td><td>'.str_replace('_',' ',$monster['zonename']).'</td></tr>
 <tr><td>Main Job:</td><td>'.strtoupper($jobs[$monster['mJob']]).'</td></tr>
 <tr><td>Sub Job:</td><td>'.strtoupper($jobs[$monster['sJob']]).'</td></tr>
 <tr><td>LVL:</td><td>'.$monster['minLevel'].' - '.$monster['maxLevel'].'</td></tr>
 <tr><td>HP:</td><td>'.$monster['gHP'].'</td></tr>
 <tr><td>Respawn:</td><td>'.($monster['respawntime']/60).' Minutes</td></tr> 
 <tr><td>Dropid</td><td>'.$monster['dropid'].'</td></tr><tr><td>Poolid</td><td>'.$monster['poolid'].'</td></tr><tr><td>Groupid</td><td>'.$monster['groupid'].'</td></tr></table>

 





';

	$drops = getDrops($monster['dropid']);
if($drops>0){
	
	$output .= '<table class="table table-condensed"><tr class="success"><td colspan=2><center><strong>Drops</strong></center></td></tr>';
 				foreach ($drops as $drop) {
					$rate=$drop['rate']/10;
				 $output .= '
                <tr><td><a href="items.php?id='.$drop['itemId'].'"><img src=http://static.ffxiah.com/images/icon/'.$drop['itemId'].'.png alt='.ucwords(str_replace('_',' ',$drop['sortname'])).' height=32 width=32> '.ucwords(str_replace('_',' ',$drop['sortname'])).'</a></td><td>'.$rate.'%</td></tr>';
				}
}
				

error_reporting(0);
	if(getCharacterGM($users['id'])>=4){
$var=ucwords($monster['zonename']);
$var2=ucwords($monster['name']);
$var3="scripts/zones/$var/mobs/$var2.lua";
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


}
$output .= '
        </div>
      </div>
    </div>
	</div>
  </body>';