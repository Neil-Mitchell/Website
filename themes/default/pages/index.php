<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-home"></span> Home</div>
        <div class="panel-body">
          <table class="table">
		  <tr>';

				 $output .= '<td>';
				 if($guide=='donate'){
					 $output .= '
					<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="neosaidin@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="FF Era">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="100" height="1">
</form></center> ';
				 }
    // Loop and print out the posts..
    while ($post_row = $db->sql_fetchrow( $posts_res ))
    {
        // Pull out topic information..
        $topic_title    = $post_row[ 'topic_title' ];
        $topic_author   = get_username_string( 'full', $post_row[ 'topic_poster' ], $post_row[ 'topic_first_poster_name' ], $post_row[ 'topic_first_poster_colour' ] );
        $topic_date     = $user->format_date( $post_row[ 'topic_time' ] );
        $topic_link     = append_sid( "{$phpbb_root_path}viewtopic.$phpEx", "t=" . $post_row[ 'topic_id' ] );
        		
		$post_text  	= trim_news_post( $post_row[ 'post_text' ], $post_row );
        
        // Print out the news post.. change this line for new design
       $output .= '
                <div class="panel panel-info"style="border:5px solid #444C56;text-align:center;background-color:#444C56;">
                    <div>
                        <strong ><a style="text-decoration: none"href="'.$topic_link.'">'.$topic_title.'</a></strong>
                    </div></br>
                    <div class="panel-body" style="text-align:left;background-color:#444C56;color:#ffffff;">
                        '.$post_text.'
                    </div>
                    <div class="panel-footer" style="text-align: right;">
                        <span class="text-muted">Posted by:</span> <strong>'.$topic_author.'</strong> <em>'.$topic_date.'</em>
                    </div>
                </div>
                ';
	}
	
				$output .= '</td>
              </tr>';
            $output .= '
          </table>
        </div>
      </div>
    </div>
	</div>
  </body>';
