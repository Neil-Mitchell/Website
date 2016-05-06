<?php

$output .= '

          
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Character List</div>
        <div class="panel-body">Unstuck Tool - Make sure character is offline.<br>If your character does not move after 3 tries contact a GM for assistance.
		<center>'.$move.'</center>		
          <table class="table">
            <thead>
              <tr>
                <th>Character Name</th>
                <th>Level</th>
                <th>Current Zone</th>
                <th>Unstuck </th>
              </tr>
            </thead>
            <tbody>';
            if ($chars == 'error') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve characters</em></td>
              </tr>';
            }
            elseif ($chars == 'empty') {
              $output .= '
              <tr>
                <td colspan=5><em>You don\'t have any characters '.($config['allow_character_creation'] ? 'use the \'Create Character\' button above to make one' : '').'</em></td>
              </tr>';
            }
            else {
              foreach ($chars as $char) {
 
                  $output .= '<tr>';
                
                $output .= '
                <td><a href="characters.php?id='.$char['charid'].'">'.$char['charname'].'</a></td>
                <td>'.$char['mlvl'].strtoupper($jobs[$char['mjob']]).(!empty($char['sjob']) ? '/'.$char['slvl'].strtoupper($jobs[$char['sjob']]) : '').'</td>
                <td>'.getZoneName($char['pos_zone']).'</td>
				<td><a href="?unstuck='.($char['charid']).'">Unstuck</a></td>
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