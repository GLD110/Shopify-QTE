<?php

//echo "<pre >";
// session_start();
require __DIR__ . '/vendor/autoload.php';

use phpish\shopify;

require __DIR__ . '/conf.php';
//require __DIR__.'../app/include/DBConnection.php';
include_once '../include/DBConnection.php';
if (isset($_SESSION['shop'])) {
    $storeName = $_SESSION['shop'];
    $query = $db->query("SELECT * FROM tbl_usersettings WHERE store_name='" . $storeName . "' ORDER BY id DESC LIMIT 1");
    $data = $query->fetch_assoc();
    $access_token = $data['access_token'];
}

$shop = $storeName;
$token = $access_token;

$shopify = shopify\client($shop, SHOPIFY_APP_API_KEY, $token);

$themes = $shopify('GET /admin/themes.json');
foreach ($themes as $value) {
    if ($value['role'] == 'main') {
        $theme_ids = $value['id'];
        //print_r($theme_ids);
    }
}

try {
    $aset_get = $shopify("GET /admin/themes/$theme_ids/assets.json?asset[key]=assets/Pop.js&theme_id=$theme_ids");
    $scropt = $shopify('GET /admin/script_tags.json');
    $Pagess = $shopify('GET /admin/pages.json');
} catch (shopify\ApiException $e) {
    if ($e->getCode() == 404) {
        $ddd = array(
            'asset' => array(
                "key" => "assets/Pop.js",
                "value" => "
			jQuery(document).ready(function(){
				var check;
				var getPage = __st.p;
				if(getPage == 'home') {
					getPage == 'home';
				} else {
					getPage = __st.rid;
				}
				jQuery('script').each(function(){
					var scripts = jQuery(this).attr('src');
					if(scripts != undefined) {
						scripts = scripts.search('bootstrap');
						if(scripts > 0) {
							check = scripts;
							return false;
						} 
						else {
							check = 0;
							return false;
						}
					}
				}); 
				if(check <= 0) {
					var script = '<link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css><script src=https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js></script><script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>';
					jQuery('head').append(script);
				} 
				var page = jQuery('body').attr('class');
				var storeName= window.location.hostname; 
				jQuery.ajax( {
					url: '//freegeoip.net/json/',
					type: 'GET',
					dataType: 'jsonp',
					success: function(location) {
						jQuery.ajax({
							type:'GET',
							url:'https://www.thirstysoftware.com/quiztoemail/PopUpAjax.php',
							data:'storeName='+storeName+'&page='+getPage+'&ip='+location.ip,
							success:function(data){
								console.log('data');
								console.log(data);
								jQuery('body').append(data);
							}
						});
					}
				});
				
			});
      ")
        );
        $qyet1 = $shopify("PUT /admin/themes/$theme_ids/assets.json", $ddd);
    }
} catch (shopify\CurlException $e) {
    # cURL error
    echo $e;
    print_r($e->getRequest());
    print_r($e->getResponse());
}


//$variant_id=$variant_query[0]['id'];
//echo fbq('init', '".$pixel_id."');
if ($scropt[0] != '') {
    foreach ($scropt as $scrp) {
        $script_id = $scrp["id"];
        $delet = $shopify("DELETE /admin/script_tags/$script_id.json");
        //print_r($delet);
    }
}
// print_r($scropt);
//echo $ids;
// print_r($aset_get ); //second file data aa raha hai
$pos = strrpos($aset_get['public_url'], '?');
$id = $pos === false ? $aset_get['public_url'] : substr($aset_get['public_url'], $pos + 1);


$data = array(
    'script_tag' => array(
        "event" => "onload",
        "src" => $aset_get['public_url'],
    )
);


try {

    $fb_query = $shopify('POST /admin/script_tags.json', $data);
    //print_r($fb_query);die;
} catch (shopify\ApiException $e) {
    # HTTP status code was >= 400 or response contained the key 'errors'
    /* echo $e;
      print_r($e->getRequest());
      print_r($e->getResponse()); */
} catch (shopify\CurlException $e) {
    # cURL error
    /* echo $e;
      print_r($e->getRequest());
      print_r($e->getResponse()); */
}



//$variant_id=$variant_query[0]['id'];
//print_r($fb_query); 

$_SESSION['id'] = $fb_query['id'];
?>
