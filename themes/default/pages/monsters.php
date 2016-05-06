<?php

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-search"></span> Monster Search</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th><form action="" method="post"><input type="text" name="name" placeholder="Enter a monster"></input>  <input type="submit" value="Search"></input></form></th>
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
			elseif($monster=='empty'){
				              $output .= '
              <tr>
                <td><em>No Monsters Found</em></td>
              </tr>';
			}
            else{
				foreach ($monster as $monsters) {
				 $output .= '
              <tr>
                <td><em><a href="?id='.$monsters['mobid'].'">'.$monsters['polutils_name'].' </a>  '.getZoneName($monsters['zoneid']).'</td>
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