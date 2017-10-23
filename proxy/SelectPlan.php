<?php
  //echo "<pre>";
  // session_start();
  require __DIR__.'/vendor/autoload.php';
  use phpish\shopify;

  require __DIR__.'/conf.php';
  //require __DIR__.'../app/include/DBConnection.php';
  include_once '../app/include/DBConnection.php';
  if(isset($_REQUEST['shop'])){
    $storeName = $_REQUEST['shop'];
    $query = $db->query("SELECT * FROM tbl_usersettings WHERE store_name='".$storeName."' ORDER BY id DESC LIMIT 1");
    $data = $query->fetch_assoc();
    $access_token = $data['access_token'];
    $id=$_GET['charge_id'];
    try {
    	 $get = $shopify("GET /admin/recurring_application_charges/$id.json");
    } 
    catch (shopify\ApiException $e){
      # HTTP status code was >= 400 or response contained the key 'errors'
    	echo $e;
    	print_r($e->getRequest());
    	print_r($e->getResponse());
    }
    catch (shopify\CurlException $e){
      # cURL error
    	echo $e;
    	print_r($e->getRequest());
    	print_r($e->getResponse());
    }

    if($get['status']=='accepted')
    {

    	try
    	{
    		$add = $shopify("POST /admin/recurring_application_charges/$id/activate.json");
    	}

    	catch (shopify\ApiException $e)
    	{
      # HTTP status code was >= 400 or response contained the key 'errors'
    		echo $e;
    		print_r($e->getRequest());
    		print_r($e->getResponse());
    	}
    	catch (shopify\CurlException $e)
    	{
      # cURL error
    		echo $e;
    		print_r($e->getRequest());
    		print_r($e->getResponse());
    	}
    	$select_settingsNew = $db->query("SELECT * FROM tbl_usersettings where store_name = '".$storeName."' ORDER BY id DESC LIMIT 1");
    	$data=$select_settingsNew->fetch_assoc();
    	if($data['paid_plan']!=1)
    	{
    		$date=date('Y-m-d');
    		$select=$db->query("UPDATE tbl_usersettings  SET paid_plan=1 WHERE id='".$data[id]."'");
    	}

    	include 'userTemplate.php';
    	include 'adminTemplate.php';

    	header('Location:https://'.$storeName.'/admin/apps/pixel-conversion-pro');
    }
  }
