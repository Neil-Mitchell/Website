<?php

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-search"></span> NPC Search</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th><form action="" method="post"><input type="text" name="name" placeholder="Enter a NPC"></input>  <input type="submit" value="Search"></input></form></th>
              </tr>
            </thead>
            <tbody>';
            if (!isset($_POST['name'])) {
				
            }
			elseif(strlen($_POST['name'])<='2'){
				              $output .= '
              <tr>
                <td><em>You Must enter more than 2 characters</em></td>
              </tr>';
			}
			elseif($npc=='empty'){
				              $output .= '
              <tr>
                <td><em>No NPCs Found</em></td>
              </tr>';
			}
			
            else{
				foreach ($npc as $npcs) {
					if($npcs['npcid'] > 0){
		$zone=$npcs['npcid'] >> 12 & 0x0FF;		
		}
				 $output .= '
				 
				 
              <tr>
                <td><em><a href="?id='.$npcs['npcid'].'">'.ucfirst(str_replace('_',' ',$npcs['polutils_name'])).'</a> '.getZoneName($zone).' </td>
              </tr>';
				}
            }
            $output .= '
            </tbody>
          </table>
        </div>
      </div>
    </div>
	</div>
  </body>';