<?php
header('Access-Control-Allow-Origin: *');

include '../include/DBConnection.php';
require_once('aweber_api/aweber_api.php');
$consumerKey    = "AkaKT6WDdepnYPUdBm0jettc";
$consumerSecret = "U1IjpJzcH2mJbmwanGfy1iB5BXAuff2layAQWVgv";
$aweber = new AWeberAPI($consumerKey, $consumerSecret);

if(isset($_REQUEST['email'])) {
    $fetch = $db->query("SELECT aweber_acess_token, aweber_accessTokenSecret FROM tbl_api_settings WHERE store_name='".$_REQUEST['hostname']."'");
    $api = $fetch->fetch_assoc();
    $account = $aweber->getAccount($api['aweber_acess_token'],$api['aweber_accessTokenSecret']);
    $account_id = $account->data['id'];
    $list_id = $_REQUEST['listid'];
    $listURL = "/accounts/{$account_id}/lists/{$list_id}";
    $list = $account->loadFromUrl($listURL);
    try {
        $params = array(
            'email' => $_REQUEST['email'],
            'name' => $_REQUEST['name'],
            );
        $subscribers = $list->subscribers;
        $new_subscriber = $subscribers->create($params);
        print "A new subscriber was added to the $list->name list!";
    } catch(AWeberAPIException $exc) {
        print "<h3>AWeberAPIException:</h3>";
        print " <li> Type: $exc->type              <br>";
        print " <li> Msg : $exc->message           <br>";
        print " <li> Docs: $exc->documentation_url <br>";
        print "<hr>";
    }

} else {
    $fetch = $db->query("SELECT aweber_acess_token, aweber_accessTokenSecret FROM tbl_api_settings WHERE store_name='".$_SESSION['shop']."'");
    $api = $fetch->fetch_assoc();
    if($api['aweber_acess_token'] != '') {
        $account = $aweber->getAccount($api['aweber_acess_token'],$api['aweber_accessTokenSecret']);
    }
}
?>
