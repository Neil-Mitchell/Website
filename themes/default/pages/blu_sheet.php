<?php

$blu = $blu[0];

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Blu Spell Sheet </em></div>
        <div class="panel-body">';
if (empty($blu['spellid'])) {
  $output .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span> Error retrieving Spell. Please check the Spell ID and try again.</div>';
}
else {
		
	  $output .= '

 <table class="table table-condensed"><tr class="success"><td colspan=2><center><strong>'.ucwords(str_replace('_',' ',$blu['name'])).'</strong></center></td></tr>';
 
 $skill = getBLUskill($blu['name']);
	if($skill == 'empty'){
		
	}else{
 				foreach ($skill as $skills) {
 
  $mobs = getBLUMobs($skills['skill_list_id']);
	if($mobs == 'empty'){
		
	}else{
 				foreach ($mobs as $mob) {
 
 
   $spawn = getBLUSpawn($mob['groupid']);
	if($spawn == 'empty'){
		
	}else{
 				foreach ($spawn as $spawns) {
				if(strlen($spawns['polutils_name'])<1){
					
				}else{
 $output .= '
				<tr><td><a href="monsters.php?id='.$spawns['mobid'].'">'.$spawns['polutils_name'].'</a></td><td>'.getZoneName($spawns['zoneid']).'</td></tr>';
				}
				}
				}
 
				}
				}
 
				}
				}


 
 

}
$output .= '</td></tr></table>
        </div>
      </div>
    </div>
	</div>
  </body>';