<?php 

 //echo "<pre >";
  // session_start();
  require __DIR__.'/vendor/autoload.php';
  use phpish\shopify;

  require __DIR__.'/conf.php';
  //require __DIR__.'../app/include/DBConnection.php';
  
  $shop = 'adrianapp.myshopify.com';
  $token = '259d89077f1fd17fc3b9a073a5155e34';

  $shopify= shopify\client($shop, SHOPIFY_APP_API_KEY, $token);


  try
  {
  	$ser = $shopify('GET /admin/carrier_services.json');
  	/*echo "<pre>";
  	print_r($ser);
  	echo "</pre>";
$shopify('DELETE /admin/carrier_services/13904842.json');*/
  $srvc = array(
  		'carrier_service' => array(
  			'name' => 'testing',
  			'callback_url' => 'https://adrianapp.myshopify.com',
  			'service_discovery' => true
  				)
  		);
  	$shopify('POST /admin/carrier_services.json',$srvc);

  }
    catch (shopify\ApiException $e)
  {
      # HTTP status code was >= 400 or response contained the key 'errors'
  	echo $e;
  	echo "<pre>";
  	print_r($e->getRequest());
  	print_r($e->getResponse());
  }
  catch (shopify\CurlException $e)
  {
      # cURL error
  	echo $e;
  		echo "<pre>";
  	print_r($e->getRequest());
  	print_r($e->getResponse());
  }
