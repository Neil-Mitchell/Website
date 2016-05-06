<?php

$output .= '

          
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Blu Spells List</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>Spell Name</th>
              </tr>
            </thead>
            <tbody>';
            if ($blu == 'error') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve spells</em></td>
              </tr>';
            }
            elseif ($blu == 'empty') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve spells</em></td>
              </tr>';
            }
            else {
              foreach ($blu as $blus) {
 
                  $output .= '<tr>';
                if(strlen($blus['name'])<1){
					
				}else{
                $output .= '
                <td><a href="?id='.$blus['spellid'].'">'.ucwords(str_replace('_',' ',$blus['name'])).'</a></td>
              </tr>';
				}
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