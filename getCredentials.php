<?php

include 'include/header.php';
use sandeepshetty\shopify_api;

if(!empty($_GET['shop']) && !empty($_GET['code'])){
  $shop = $_GET['shop'];
  $access_token = shopify_api\oauth_access_token($_GET['shop'], $app_settings->api_key, $app_settings->shared_secret, $_GET['code']);
  $db->query("INSERT INTO tbl_usersettings SET access_token = '$access_token',store_name = '$shop'");
  $_SESSION['shopify_signature'] = $_GET['signature'];
  $_SESSION['shop'] = $shop;
  header('Location: https://'.$shop.'/admin/apps');
}

?>