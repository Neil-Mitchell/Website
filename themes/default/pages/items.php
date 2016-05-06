<?php

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-search"></span> Item Search</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th><form action="" method="post"><input type="text" name="name" placeholder="Enter a Item"></input>  <input type="submit" value="Search"></input></form></th>
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
			elseif($item=='empty'){
				              $output .= '
              <tr>
                <td><em>No Items Found</em></td>
              </tr>';
			}
			
            else{
				foreach ($item as $items) {
				 $output .= '
              <tr>
                <td><em><a href="?id='.$items['itemid'].'">'.ucfirst(str_replace('_',' ',$items['sortname'])).' </a></td>
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