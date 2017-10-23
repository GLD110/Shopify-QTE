<?php 
header('Access-Control-Allow-Origin: *');

include('src/MailChimp.php'); 
include('src/Batch.php'); 
include('src/Webhook.php'); 
include('../include/DBConnection.php');

use \DrewM\MailChimp\MailChimp;

if(isset($_REQUEST['email'])) {
	$fetch = $db->query("SELECT mailchimp_api_key FROM tbl_api_settings WHERE store_name='".$_REQUEST['hostname']."'");
	$api = $fetch->fetch_assoc();
	$MailChimp = new MailChimp($api['mailchimp_api_key']);
	$list_id = $_REQUEST['listid'];
	$name = $_REQUEST['name'];
$result = $MailChimp->post("lists/$list_id/members", [
		'email_address' => $_REQUEST['email'],
		'status'        => 'subscribed',
		'merge_fields' => ['FNAME'=> $name],
		]);
	echo "done";
} else {
	$fetch = $db->query("SELECT mailchimp_api_key FROM tbl_api_settings WHERE store_name='".$_SESSION['shop']."'");
	$api = $fetch->fetch_assoc();
	if($api['mailchimp_api_key'] != '') {
			$MailChimp = new MailChimp($api['mailchimp_api_key']);
			$List = $MailChimp->get('lists');		
	}

}

?>
