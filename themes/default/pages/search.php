<?php

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-search"></span> Character Search</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th><form action="" method="post"><input type="text" name="name" placeholder="Enter a Character Name"></input>  <input type="submit" value="Search"></input></form></th>
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
			elseif($names=='empty'){
				              $output .= '
              <tr>
                <td><em>No Characters Found</em></td>
              </tr>';
			}
			
            else{
				foreach ($names as $char) {

				 $output .= '
				 
				 
              <tr>
                <td><em><a href="characters.php?id='.$char['charid'].'">'.$char['charname'].'</a> '.getZoneName($char['pos_zone']).' </td>
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