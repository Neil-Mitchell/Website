<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 
 
	$output .= '  

  <nav class="navbar navbar-default navbar-inverse" role="navigation" background-color:#20262E;">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Era</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="'.PROTOCOL . BASE_PATH .'index.php">Home</a></li>
						<li><a href="../forums/" target="_Forums">Forums</a></li>
						<li><a href="../wiki/" target="_Wiki">Wiki</a></li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reporting<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="tickets/">Service Requests</a>
								</li>
								<li>
									<a href="https://github.com/myera/issues/issues">Bug Reporting</a>
								</li>					
							</ul>
						</li>
						<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Guides<strong class="caret"></strong></a>
    <ul class="dropdown-menu">
							<li>
								<a href="?guide=install">Install Guide</a>
							</li>
							<li>
								<a href="?guide=update">How To Update</a>
							</li>
							<li>
								<a href="?guide=custom">Custom Index</a>
							</li>
      </ul>
	  </li>
	  <li><a href="?guide=donate">Donate</a></li>
      </ul>
';
        
        $output .= '
    </div><!-- /.navbar-collapse -->
</nav><div class="row clearfix">
  
	<div class="col-md-3">';

if (!empty($errors)) {
    $output .= '
      <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Please correct the following errors:
          <ul>';
    foreach ($errors['form-help'] as $error) {
        $output .= '
            <li>'.$error.'</li>';
    }
    $output .= '
          </ul>
      </div>';    
}

$output .= '

      <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-lock"></span> Character Log In</div>
        <div class="panel-body">
          <form method="POST" action="login.php">
            <div id="username-group" class="form-group '.(!empty($errors['username']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Username'.(!empty($errors['username']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['username'] : '').'</label>
              <input type="text" name="username" class="form-control" value="'.$username.'" />
            </div>
            <div id="password-group" class="form-group '.(!empty($errors['password']) ? 'has-error' : '').'">
              <label class="control-label" for="username">Password '.(!empty($errors['password']) ?  '- <span class="glyphicon glyphicon-remove"></span> '.$errors['password'] : '').'</label>
              <input type="password" name="password" class="form-control" value="'.$password.'" />
            </div>
            <input type="hidden" name="auth" value="1">
            <button class="btn btn-primary" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>    <div class="col-md-8">';
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
                        <strong ><a style="text-decoration: none"href="{$topic_link}">'.$topic_title.'</a></strong>
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
