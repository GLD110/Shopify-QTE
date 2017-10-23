<?php
  //echo "<pre>";
  // session_start();
  require __DIR__.'/vendor/autoload.php';
  use phpish\shopify;

  require __DIR__.'/conf.php';
  //require __DIR__.'../app/include/DBConnection.php';
  include_once '../app/include/DBConnection.php';
  if(isset($_SESSION['shop'])){
    $storeName = $_SESSION['shop'];
    $query = $db->query("SELECT * FROM tbl_usersettings WHERE store_name='".$storeName."' ORDER BY id DESC LIMIT 1");
    $data = $query->fetch_assoc();
    $access_token = $data['access_token'];
  }
  $shop = $storeName;
  $token = $access_token;

  $shopify= shopify\client($shop, SHOPIFY_APP_API_KEY, $token);
try {
$getproduct  = $shopify('GET /admin/products.json');
echo "<pre>";
print_r($getproduct);
echo "</pre>";

	$array = array(
		"recurring_application_charge"=>array(
			'name'=>'7 Day Trial Plan',
			'price'=> '5.0',
			'trial_days'=> '7',
			'return_url'=>'https://'.$_SERVER['HTTP_HOST'].'/QuizApp/proxy/SelectPlan.php?shop='.strtolower($_REQUEST['shop'])
			)
		);

  $array2 = array(
    "metafield"=>array(
      'namespace'=>'inventory',
      'key' => 'warehouse',
      'value' => 25,
      'value_type' => 'integer'
      )
    );

	/*$add = $shopify('POST /admin/products/10260415882/metafields.json' , $array2);
  echo "<pre>";
  print_r($add);
  echo "</pre>";*/
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
if(!empty($add['confirmation_url'])) { ?>
	<script>
		//window.location.href="<?php echo $add['confirmation_url'] ?>"; 
	</script>
<?php 
}