<?php

$npc = $npc[0];

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> NPC Sheet </em></div>
        <div class="panel-body">';
if (empty($npc['npcid'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving NPC. Please check the NPC ID and try again.</div>';
}
else {
			
				if($npc['npcid'] > 0){
		$zone=$npc['npcid'] >> 12 & 0x0FF;		
		}
		$pos=$npc['pos_x']+$npc['pos_y']+$npc['pos_z'];
	  $output .= '

 <table class="table table-condensed"><tr class="success"><td colspan=2><center><strong>'.$npc['polutils_name'].'</strong></center></td></tr>
 <tr><td>Zone:</td><td>'.getZoneName($zone).'</td></tr>';
 if($pos>0){
 $output .= '
 <tr><td>POS:</td><td>'.$npc['pos_x'].' '.$npc['pos_y'].' '.$npc['pos_z'].'</td></tr>';
}else{
 $output .= '
<tr><td>POS:</td><td>This NPC is more then likely incorrect or used in a cutscene!</td></tr>';
}
 $output .= '
 <tr><td>Expansion:</td><td>'.$npc['required_expansion'].'</td></tr><tr><td colspan=2>
 ';
 error_reporting(0);
if(getCharacterGM($users['id'])>=4){
$var=str_replace(' ','_',getZoneName($zone));
$var2=ucwords($npc['name']);
$var3="scripts/zones/$var/npcs/$var2.lua";
$myfile = fopen("$var3", "r");
if(!$myfile){
}else{
 $output .= '<textarea rows="25" cols="100">
'.fread($myfile,filesize($var3)).' </textarea>';
fclose($myfile);
}
}
else{
	
}
 
 

}
$output .= '</td></tr></table>
        </div>
      </div>
    </div>
	</div>
  </body>';