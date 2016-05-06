<?php

define('PROTOCOL',"http://"); // Protocol to use (http:// or https://) [Default: [http://]
define('BASE_PATH',"ffera.com/"); // Base path of the install (After the protocol, leave out trailing /)

  // Handle phpBB includes..
    define('IN_PHPBB', true); 
    $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : 'forums/'; 
    $phpEx = substr(strrchr(__FILE__, '.'), 1); 
    include($phpbb_root_path . 'common.' . $phpEx); 
    include($phpbb_root_path . 'includes/bbcode.' . $phpEx); 
    include($phpbb_root_path . 'includes/functions_display.' . $phpEx); 

    // Start phpBB Session.. 
    $user->session_begin(); 
    $auth->acl($user->data); 
    $user->setup('viewforum'); 
    


$config['dspdb_host'] = 'localhost'; // Hostname of the DSP Database Server
$config['dspdb_port'] = '3306'; // Port of the DSP Database Server [Default: 3306]
$config['dspdb_user'] = 'user'; // Username of the DSP Database User
$config['dspdb_pass'] = 'password'; // Password of the DSP Database User
$config['dspdb_name'] = 'dspdb'; // Name of the DSP Database
$config['theme'] = 'default'; // The theme to use for the interface (Located in the /themes/ directory) [Default: default]


?>
