<?php
require_once("includes/config.php");
require_once("includes/global.php");

if (!empty($users['authed'])) {
  $_SESSION['cms'] = '';
  $_SESSION['cms_Username'] = '';
}
redirects("login.php");
