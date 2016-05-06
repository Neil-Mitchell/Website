<?php
require_once("includes/config.php");
require_once("includes/global.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 
 
 
if (!empty($users['authed'])) {
    if (!empty($_SESSION['destination'])) {
        $page = $_SESSION['destination'];
        $_SESSION['destination'] = '';
    }
    else {
        $page = "index.php";
    }
    redirects($page);
}

$username = '';
$password = '';

if (!empty($_POST['auth'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $errors['form-help'][] = 'Missing required fields';
        if (empty($_POST['username'])) {
            $errors['form-help'][] = 'Username field required';
            $errors['username'] = 'Required';
        }
        else {
            $username = $_POST['username'];
        }
        if (empty($_POST['password'])) {
            $errors['form-help'][] = 'Password field required';
            $errors['password'] = 'Required';
        }
        else {
            $password = $_POST['password'];
        }
    }
    else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      if (!doLogin($username,$password)) {
        $errors['form-help'][] = 'Could not log in using the credentials provided';
        $errors['username'] = 'Invalid';
        $errors['password'] = 'Invalid';
      }
      else {
        authenticate($username);
        $_SESSION['cms'] = true;
        $_SESSION['cms_Username'] = $username;
        if (!empty($_SESSION['destination'])) { $page = $_SESSION['destination']; } else { $page = "index.php"; }
        redirects("$page");
        $_SESSION['destination'] = '';
      }
    }
}

	$guide='';
		  if(!empty($_GET['guide'])){
			  $guide=$_GET['guide'];
			  if($guide=='install'){
				  // Determine what forum to get posts from..
    $forum_id = array(0);
    $forum_id_where = create_where_clause( $forum_id, 'forum' );
    // show last x topics
    $search_limit = 1;
    
    // Build query..
    $post_arr = array(
        'SELECT'    => 'p.*, t.*',
        'FROM'      => array( POSTS_TABLE => 'p' ),
        'LEFT_JOIN' => array( array(
            'FROM'  => array( TOPICS_TABLE => 't' ),
            'ON'    => 't.topic_first_post_id = p.post_id' ) ),
        'WHERE'     => str_replace( array( 'WHERE ', 'forum_id' ), array( '', 't.forum_id' ), $forum_id_where ) . ' AND t.topic_id = 1943'. '', // Hides announcements, stickied and global posts..
        'ORDER_BY'  => 'p.post_id DESC' );
        
    // Pull the posts from the database..
    $posts = $db->sql_build_query( 'SELECT', $post_arr );
    $posts_res = $db->sql_query_limit( $posts, $search_limit );
			  }
			  elseif($guide=='update'){
				      // Determine what forum to get posts from..
    $forum_id = array(9);
    $forum_id_where = create_where_clause( $forum_id, 'forum' );
    // show last x topics
    $search_limit = 1;
    
    // Build query..
    $post_arr = array(
        'SELECT'    => 'p.*, t.*',
        'FROM'      => array( POSTS_TABLE => 'p' ),
        'LEFT_JOIN' => array( array(
            'FROM'  => array( TOPICS_TABLE => 't' ),
            'ON'    => 't.topic_first_post_id = p.post_id' ) ),
        'WHERE'     => str_replace( array( 'WHERE ', 'forum_id' ), array( '', 't.forum_id' ), $forum_id_where ) . ' AND t.topic_id = 101'. '', // Hides announcements, stickied and global posts..
        'ORDER_BY'  => 'p.post_id DESC' );
        
    // Pull the posts from the database..
    $posts = $db->sql_build_query( 'SELECT', $post_arr );
    $posts_res = $db->sql_query_limit( $posts, $search_limit );

			  }
			  elseif($guide=='custom'){
				  
    // Determine what forum to get posts from..
    $forum_id = array(0);
    $forum_id_where = create_where_clause( $forum_id, 'forum' );
    // show last x topics
    $search_limit = 1;
    
    // Build query..
    $post_arr = array(
        'SELECT'    => 'p.*, t.*',
        'FROM'      => array( POSTS_TABLE => 'p' ),
        'LEFT_JOIN' => array( array(
            'FROM'  => array( TOPICS_TABLE => 't' ),
            'ON'    => 't.topic_first_post_id = p.post_id' ) ),
        'WHERE'     => str_replace( array( 'WHERE ', 'forum_id' ), array( '', 't.forum_id' ), $forum_id_where ) . ' AND t.topic_id = 2249'. '', // Hides announcements, stickied and global posts..
        'ORDER_BY'  => 'p.post_id DESC' );
        
    // Pull the posts from the database..
    $posts = $db->sql_build_query( 'SELECT', $post_arr );
    $posts_res = $db->sql_query_limit( $posts, $search_limit );

			  }
			  elseif($guide=='donate'){
			      // Determine what forum to get posts from..
    $forum_id = array(0);
    $forum_id_where = create_where_clause( $forum_id, 'forum' );
    // show last x topics
    $search_limit = 1;
    
    // Build query..
    $post_arr = array(
        'SELECT'    => 'p.*, t.*',
        'FROM'      => array( POSTS_TABLE => 'p' ),
        'LEFT_JOIN' => array( array(
            'FROM'  => array( TOPICS_TABLE => 't' ),
            'ON'    => 't.topic_first_post_id = p.post_id' ) ),
        'WHERE'     => str_replace( array( 'WHERE ', 'forum_id' ), array( '', 't.forum_id' ), $forum_id_where ) . ' AND t.topic_id = 1952'. '', // Hides announcements, stickied and global posts..
        'ORDER_BY'  => 'p.post_id DESC' );
        
    // Pull the posts from the database..
    $posts = $db->sql_build_query( 'SELECT', $post_arr );
    $posts_res = $db->sql_query_limit( $posts, $search_limit );

			  }
			  else{
	// Determine what forum to get posts from..
    $forum_id = array(0);
    $forum_id_where = create_where_clause( $forum_id, 'forum' );
    // show last x topics
    $search_limit = 1;
    
    // Build query..
    $post_arr = array(
        'SELECT'    => 'p.*, t.*',
        'FROM'      => array( POSTS_TABLE => 'p' ),
        'LEFT_JOIN' => array( array(
            'FROM'  => array( TOPICS_TABLE => 't' ),
            'ON'    => 't.topic_first_post_id = p.post_id' ) ),
        'WHERE'     => str_replace( array( 'WHERE ', 'forum_id' ), array( '', 't.forum_id' ), $forum_id_where ) . ' AND t.topic_id = 2559'. '', // Hides announcements, stickied and global posts..
        'ORDER_BY'  => 'p.post_id DESC' );
        
    // Pull the posts from the database..
    $posts = $db->sql_build_query( 'SELECT', $post_arr );
    $posts_res = $db->sql_query_limit( $posts, $search_limit );  
			  }

	}else{
		$guide='';
	// Determine what forum to get posts from..
    $forum_id = array(0);
    $forum_id_where = create_where_clause( $forum_id, 'forum' );
    // show last x topics
    $search_limit = 1;
    
    // Build query..
    $post_arr = array(
        'SELECT'    => 'p.*, t.*',
        'FROM'      => array( POSTS_TABLE => 'p' ),
        'LEFT_JOIN' => array( array(
            'FROM'  => array( TOPICS_TABLE => 't' ),
            'ON'    => 't.topic_first_post_id = p.post_id' ) ),
        'WHERE'     => str_replace( array( 'WHERE ', 'forum_id' ), array( '', 't.forum_id' ), $forum_id_where ) . ' AND t.topic_id = 2559'. '', // Hides announcements, stickied and global posts..
        'ORDER_BY'  => 'p.post_id DESC' );
        
    // Pull the posts from the database..
    $posts = $db->sql_build_query( 'SELECT', $post_arr );
    $posts_res = $db->sql_query_limit( $posts, $search_limit );
		
	}

include("themes/".$config['theme']."/pages/header.php");
include("themes/".$config['theme']."/pages/login.php");
include("themes/".$config['theme']."/pages/footer.php");
echo $output;