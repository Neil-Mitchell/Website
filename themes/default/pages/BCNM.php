<?php

$output .= '

          
      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> BCNM List</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>BCNM Name</th>
                <th>Level Cap</th>
                <th>Zone</th>
              </tr>
            </thead>
            <tbody>';
            if ($BCNM == 'error') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve BCNMs</em></td>
              </tr>';
            }
            elseif ($BCNM == 'empty') {
              $output .= '
              <tr>
                <td colspan=5><em>Could not retrieve BCNMs</em></td>
              </tr>';
            }
            else {
              foreach ($BCNM as $BCNMs) {
 
                  $output .= '<tr>';
                
                $output .= '
                <td><a href="?id='.$BCNMs['bcnmId'].'">'.ucwords(str_replace('_',' ',$BCNMs['name'])).'</a></td>';
				if($BCNMs['levelCap']==0){
					$output .= '<td>Uncapped</td>';
				}
				else{
					$output .= '<td>'.$BCNMs['levelCap'].'</td>';
				}
				$output .= '
                <td>'.getZoneName($BCNMs['zoneId']).'</td>
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