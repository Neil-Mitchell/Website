<?
ini_set('display_errors', 0);
function job_to_name( $job_id )
    {
        $jobs = array('','war','mnk','whm','blm','rdm','thf','pld','drk','bst','brd','rng','sam','nin','drg','smn','blu','cor','pup','dnc','sch','geo','run');
        return strtolower( $jobs[ $job_id ] );
    }
	
function hex2rgb($hex) {
	$hex = substr($hex, 1);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,2,1).substr($hex,2,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,0,1).substr($hex,0,1));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}

		$db1 = mysqli_connect("localhost","website","Wehavetochangethispassword2","dspdb");
        

    $sql = "SELECT chars.accid, chars.charid, chars.charname, chars.gmlevel, accounts_sessions.linkshellid1, accounts_sessions.linkshellrank1, accounts_sessions.linkshellid2, accounts_sessions.linkshellrank2, chars.pos_zone from accounts_sessions INNER JOIN chars ON accounts_sessions.charid = chars.charid ORDER BY charname";
    $res = $db1->query($sql) or die("Error " . mysqli_error($db1));
    while($row = mysqli_fetch_array($res))
    {
		$charid=$row[1];
			
				$sql2 = "SELECT * from zone_settings where zoneid='{$row[8]}';";
				$res2 = $db1->query($sql2) or die("Error " . mysqli_error($db1));
				$row2 = mysqli_fetch_array($res2);			
				$zone=$row2[4];
				$zone=str_replace('_',' ',$zone);
		print "<tr class='active'><td width=10%>";
		if($row[4]>0){
			    $sql1 = "SELECT * from linkshells where linkshellid='{$row[4]}';";
				$res1 = $db1->query($sql1) or die("Error " . mysqli_error($db1));
				$row1 = mysqli_fetch_array($res1);
				

		$row[4]=$row1[2];
		$row[4]=dechex($row[4]);
		$rgb = hex2rgb($row[4]);
		if($row[5]==1){
			$img='images/shell.png';
		}
		if($row[5]==2){
			$img='images/sack.png';			
		}
		if($row[5]==3){
			$img='images/pearl.png';			
		}

		
		print "<div style='width: 25px; height: 25px; background-color:rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},1)'><img src='$img' height=25 width=25 alt='{$row1[1]}' title='{$row1[1]}'/></div>";
		}else{
		print "";
		}
		if($row[6]>0){
			    $sql1 = "SELECT * from linkshells where linkshellid='{$row[6]}';";
				$res1 = $db1->query($sql1) or die("Error " . mysqli_error($db1));
				$row1 = mysqli_fetch_array($res1);
				

		$row[4]=$row1[2];
		$row[4]=dechex($row[4]);
		$rgb = hex2rgb($row[4]);
		if($row[7]==1){
			$img='images/shell.png';
		}
		if($row[7]==2){
			$img='images/sack.png';			
		}
		if($row[7]==3){
			$img='images/pearl.png';			
		}

		
		print "<div style='width: 25px; height: 25px; background-color:rgba({$rgb[0]},{$rgb[1]},{$rgb[2]},1)'><img src='$img' height=25 width=25 alt='{$row1[1]}' title='{$row1[1]}'/></div></td>";
		}else{
		print "</td>";
		}
$stats= "SELECT * from char_stats where charid='$charid'"  or die("Error in the consult.." . mysqli_error($db1)); 
$stats1 = $db1->query($stats) or die("Error " . mysqli_error($db1));
$stats2 = mysqli_fetch_array($stats1);

$mjob=job_to_name($stats2['mjob']);
$sjob=job_to_name($stats2['sjob']);
$job= "SELECT * from char_jobs where charid='$charid'"  or die("Error in the consult.." . mysqli_error($db1)); 
$job1 = $db1->query($job) or die("Error " . mysqli_error($db1));
$job2 = mysqli_fetch_array($job1);


$mjoblevel=$job2[$mjob];
$sjoblevel=$job2[$sjob];
if($mjoblevel==1){
$sjoblevel=floor(min($sjoblevel,($mjoblevel)));
}
else{
$sjoblevel=floor(min($sjoblevel,($mjoblevel/2)));
}
if($sjoblevel==0){
	$sjoblevel="";
}
$mjob=strtoupper($mjob);
$sjob=strtoupper($sjob);

$sql2 = mysqli_connect("localhost","website","Wehavetochangethispassword2","eraforums");
        $querys = "SELECT * from characters where charid='$row[1]'";
        $results = $sql2->query($querys);
		$rows = mysqli_fetch_array($results);
		if(!$rows){
		
        print("<td><b>{$row[2]}(0)</b><br><font size=1>$mjob$mjoblevel/$sjob$sjoblevel</font></td><td>$zone</td><tr>");
		
		}else{
		
			
$ranks= "SELECT * from ranks where charid='$row[1]'"  or die("Error in the consult.." . mysqli_error($sql2)); 
$ranks1 = $sql2->query($ranks) or die("Error " . mysqli_error($sql2));
$ranks2 = mysqli_fetch_array($ranks1);
$rpoints=$ranks2['points'];
$rank3= "SELECT * from ranks where points>='$rpoints' and gm='0'"  or die("Error in the consult.." . mysqli_error($sql2)); 
$rank1 = $sql2->query($rank3) or die("Error " . mysqli_error($sql2));
$rank2 = mysqli_num_rows($rank1);
			
		print("<td><b><a href='../forums/profile.php?p={$row[1]}'>{$row[2]}($rank2)</a></b><br><font size=1>$mjob$mjoblevel/$sjob$sjoblevel</font></td><td>$zone</td><tr>");	
		
        }

		
    }
	
?>
