<?php 

require('aweber_api/aweber_api.php');

# replace XXX with your App ID
$appID = 'a5b9663e';

# prompt user to go to authorization URL
//echo "Go to this url in your browser: {".$this->application->getAuthorizeUrl()."}";

# prompt user to enter authorization code
echo 'Type authorization code here: ';
$code = trim(fgets(STDIN));

# exchange authorization code for new consumer keys and secrets, and an access token key and secret
$credentials = AWeberAPI::getDataFromAweberID($code);
$LISTS = list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = $credentials;
echo "<pre>";
print_r($LISTS);
echo "</pre>";
?>