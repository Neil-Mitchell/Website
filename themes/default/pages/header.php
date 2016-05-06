<?php

$output = 
'<!DOCTYPE html>
<html lang="en">
  <head>
	    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Era &bull; A private server community.</title>
<meta name="robots" content="index, follow" />
<meta name="keywords" content="era, free ffxi, free mmo, myera, myera ffxi, wotg, toau, 75 cap, ffxi community, free mmo, free to play, ffxi free to play, ffxi, free mmo, mmorpg, rpg, role playing game, final fantasy xi, zilart, promathia, cop, final fantasy xi, era ffxi">
<meta name="description" content="Era FFXI Private Server is devoted to 75 cap content. Our project goal is focused on streamlining leveling and enhancing endgame experience, by focusing on custom content." />
<meta name="author" content="Era Revo">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->
	<link rel="icon" 
      type="ico" 
      href="http://ffera.com/cms/favicon.ico">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="themes/'.$config['theme'].'/pages/js/ajax.js"></script>
	<script src="themes/'.$config['theme'].'/pages/js/hover.js"></script>
    <link rel="stylesheet" type="text/css" href="themes/'.$config['theme'].'/pages/css/stylesheet.css">
		<style>
	body
{
background: rgba(10,10,55,1);

}

</style>
  </head><body>
';
  if (!empty($users['authed'])) {
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
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Characters <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="'.PROTOCOL . BASE_PATH .'characters.php"><span class="glyphicon glyphicon-eye-open"></span> View All Characters</a></li>
            <li role="separator" class="divider"></li>';
            $characters = getCharacterList($users['id']);
              if ($characters !== 'empty' && $characters !== 'error') {
                foreach ($characters as $character) {
                  $output .= '
            <li><a href="'.PROTOCOL . BASE_PATH .'characters.php?id='.$character['charid'].'"><span class="glyphicon glyphicon-user"></span> '.$character['charname'].'</a></li>
                  ';
                }
              }
            $output .= '
          </ul>
        </li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="search.php"><span class="glyphicon glyphicon-search"></span> Character Search</a>
								</li>
								<li>
									<a href="monsters.php"><span class="glyphicon glyphicon-search"></span> Monsters</a>
								</li>
								<li>
									<a href="items.php"><span class="glyphicon glyphicon-search"></span> Items</a>
								</li>								
								<li>
									<a href="npc.php"><span class="glyphicon glyphicon-search"></span> NPC</a>
								</li>
								<li>
									<a href="crafts.php"><span class="glyphicon glyphicon-list"></span> Crafting</a>
								</li>
								<li>
									<a href="BCNM.php"><span class="glyphicon glyphicon-list"></span> BCNM</a>
								</li>
								<li>
									<a href="blu.php"><span class="glyphicon glyphicon-list"></span> BLU</a>
								</li>
								<li class="divider">
								<li>
									<a href="#"><span class="glyphicon glyphicon-wrench"></span> Linkshell Manager</a>
								</li>
								</li>
								<li>
									<a href="#"><span class="glyphicon glyphicon-usd"></span> Auction House</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#"><span class="glyphicon glyphicon-globe"></span> Ranks</a>
								</li>
							</ul>
						</li>
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
								<a href="index.php?guide=install">Install Guide</a>
							</li>
							<li>
								<a href="index.php?guide=update">How To Update</a>
							</li>
							<li>
								<a href="index.php?guide=custom">Custom Index</a>
							</li>
      </ul>
	  </li>
	  <li><a href="index.php?guide=donate">Donate</a></li>
	  </ul>
	  
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Account</a></li>
        <li><a href="'.PROTOCOL . BASE_PATH .'logout.php">Logout</a></li>';
        
        $output .= '
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>
	<div class="row clearfix">
  
	<div class="col-md-3">';

$sts=1;
$fp = fsockopen("ffera.com", 54231, $errno, $errstr, 1);
if($fp !== false) $sts=0;
			if($sts==0){
			$output .= '<div class="alert alert-info">
				<strong>Status: Online</strong>';
	$db1 = mysqli_connect("localhost","user","pass","dspdb");
    $sql = "SELECT count(accid) from accounts_sessions where accid>0";
    $res = $db1->query($sql) or die("Error " . mysqli_error($db1));
    $row = mysqli_fetch_assoc($res);
	$online2=$row['count(accid)'];
	
	$output .= '
			</div>';
			}else{
			$output .= '
			<div class="alert alert-danger">
				<strong>Status: Offline</strong>
			</div>';
			}	
	
	
	    $output .= '<div class="panel panel-primary">
        <div class="panel-heading"><a style="cursor: pointer;" data-toggle="collapse" data-target="#online"><strong><font color=white><span class="glyphicon glyphicon-plus"></span> Online List: '.$online2.'</font></strong></a></div>
        <div class="panel-body collapse" id="online"><table class="table table-condensed">';
$onlinelist = getOnlineList(1);
	if($onlinelist == 'empty'){
		
	}else{
 				foreach ($onlinelist as $online) {
					$link="";
					$linkshell=getLinkshell($online['linkshellid1']);
					if($linkshell=='empty'){
									
					
						$rgb=0;
						$output .= '<tr class="active"><td>';
					}
					else{
						$color=dechex($linkshell['color']);
						$rgb = hex2rgb($color);
						if($rgb=='empty'){
						}else{
						$output .= '<tr class="active"><td><div style="width: 25px; height: 25px; background-color:rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',1)">';
						if($online['linkshellrank1']==1){
					$output .= '<img src="themes/default/pages/images/shell.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					}
					elseif($online['linkshellrank1']==2){
					$output .= '<img src="themes/default/pages/images/sack.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					}
					elseif($online['linkshellrank1']==3){
					$output .= '<img src="themes/default/pages/images/pearl.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					}
					else{
					$output .= '</div>';
					
						}
					}
					}
					
										$link="";
					$linkshell=getLinkshell($online['linkshellid2']);
					if($linkshell=='empty'){
									
					
						$rgb=0;
						$output .= '';
					}
					else{
						$color=dechex($linkshell['color']);
						$rgb = hex2rgb($color);
						if($rgb=='empty'){
						}else{
						$output .= '<div style="width: 25px; height: 25px; background-color:rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].',1)">';
						if($online['linkshellrank2']==1){
					$output .= '<img src="themes/default/pages/images/shell.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					}
					elseif($online['linkshellrank2']==2){
					$output .= '<img src="themes/default/pages/images/sack.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					}
					elseif($online['linkshellrank2']==3){
					$output .= '<img src="themes/default/pages/images/pearl.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					}
					else{
					$output .= '<img src="themes/default/pages/images/pearl.png" height="25" width="25" alt="'.$linkshell['name'].'" title="'.$linkshell['name'].'"></div>';
					
						}
					}
					}
					
					
					
					
	  
	  $output .= '
	  </td><td><a href="characters.php?id='.$online['charid'].'">'.$online['charname'].'</a><br>'.$online['mlvl'].strtoupper($jobs[$online['mjob']]).(!empty($online['sjob']) ? '/'.$online['slvl'].strtoupper($jobs[$online['sjob']]) : '').'</td><td>'.getZoneName($online['pos_zone']).'</td></tr>
	  
	  
	  ';
				}
	}

		  $output .= '
		  </table>
        </div>
		</div>
		</div>
    <div class="col-md-8">

	
  ';   
  }  
    