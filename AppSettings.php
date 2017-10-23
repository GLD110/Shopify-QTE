<?php
include 'include/header.php';
require_once('Aweber/aweber_api/aweber_api.php');

$consumerKey = "AkaKT6WDdepnYPUdBm0jettc";
$consumerSecret = "U1IjpJzcH2mJbmwanGfy1iB5BXAuff2layAQWVgv";
$aweber = new AWeberAPI($consumerKey, $consumerSecret);


$fetch = $db->query("SELECT id,mailchimp_api_key,aweber_acess_token,aweber_accessTokenSecret FROM tbl_api_settings WHERE store_name='" . $_SESSION['shop'] . "'");
$api = $fetch->fetch_assoc();

if (isset($_REQUEST['saveApi'])) {
    if (mysqli_num_rows($fetch) > 0) {
        $db->query("UPDATE tbl_api_settings SET mailchimp_api_key='" . $_REQUEST['mailchimp-api-key'] . "' WHERE store_name='" . $_SESSION['shop'] . "'");
    } else {
        $db->query("INSERT INTO tbl_api_settings (`mailchimp_api_key`,`store_name`) VALUES('" . $_REQUEST['mailchimp-api-key'] . "','" . $_SESSION['shop'] . "')");
    }
    $_SESSION['alert'] = 'Successfully Inserted';
    header("Refresh:0");
}
if (isset($_REQUEST['generateToken'])) {
    if (empty($_SESSION['accessToken'])) {

        if (empty($_GET['oauth_token'])) {
            $callbackUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
            $_SESSION['requestTokenSecret'] = $requestTokenSecret;
            $_SESSION['callbackUrl'] = $callbackUrl;
            header("Location: {$aweber->getAuthorizeUrl()}");
            exit();
        }
    }
}
if (isset($_REQUEST['removeToken'])) {

    $db->query("UPDATE tbl_api_settings SET aweber_acess_token='', aweber_accessTokenSecret='' WHERE store_name='" . $_SESSION['shop'] . "'");
    $_SESSION['alert'] = 'Successfully Removed Your AWeber Account!';
    unset($_SESSION['requestTokenSecret']);
    unset($_SESSION['accessToken']);
    unset($_SESSION['callbackUrl']);
    unset($_SESSION['accessTokenSecret']);

    if (!empty($_GET['oauth_token'])) {

        $currentUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $strippedUrl = removeQueryStringVariable($currentUrl, 'oauth_token');
        header("Location: {$strippedUrl}");
    } else {

        header("Refresh:0");
    }
}
if (isset($_REQUEST['oauth_token'])) {
    try {
        $aweber->user->tokenSecret = $_SESSION['requestTokenSecret'];
        $aweber->user->requestToken = $_REQUEST['oauth_token'];
        $aweber->user->verifier = $_REQUEST['oauth_verifier'];
        list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
        $_SESSION['accessToken'] = $accessToken;
        $_SESSION['accessTokenSecret'] = $accessTokenSecret;
        if (mysqli_num_rows($fetch) > 0) {
            $db->query("UPDATE tbl_api_settings SET aweber_acess_token='" . $accessToken . "', aweber_accessTokenSecret='" . $accessTokenSecret . "' WHERE store_name='" . $_SESSION['shop'] . "'");
        } else {
            $db->query("INSERT INTO tbl_api_settings (`aweber_acess_token`,`aweber_accessTokenSecret`,`store_name`) VALUES('" . $accessToken . "','" . $accessTokenSecret . "','" . $_SESSION['shop'] . "')");
        }
        $_SESSION['alert'] = 'Successfully Generated';
    } catch (AWeberAPIException $exc) {
        //print "<li> $exc->type on $exc->url, refer to $exc->message for more info ...<br>";
    }
}

function removeQueryStringVariable($url, $param) {
    $base_url = strtok($url, '?');              // Get the base url
    $parsed_url = parse_url($url);              // Parse it 
    $query = $parsed_url['query'];              // Get the query string
    parse_str($query, $parameters);           // Convert Parameters into array
    unset($parameters[$param]);               // Delete the one you want
    $new_query = http_build_query($parameters); // Rebuilt query string
    return $base_url . '?' . $new_query;
}
?>
<div id="apiPage">
    <!--left part -->
    <div class="col-md-6">
        <!-- start box-->
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Mailchimp</h3>
            </div>
            <!-- start box body-->
            <div class="box-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="mailchimp-api-key" class="col-sm-2 control-label">Api Key : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mailchimp-api-key" name="mailchimp-api-key" placeholder="Enter Mailchimp Api Key" required value="<?php echo $api['mailchimp_api_key']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mailchimp-api-key" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary" name="saveApi">Save</button>
                            <a href="AppMain.php"><span class="btn btn-default">Back</span></a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- start box body-->
        </div>
        <!-- start box-->
    </div>	
    <!--left part -->
    <!--right part -->
    <div class="col-md-6">
        <!-- start box-->
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Aweber</h3>
            </div>
            <!-- start box body-->
            <div class="box-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="aweber-api-key" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <?php if ($api['aweber_acess_token'] != '') { ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> App is connected to Your Aweber Account.
                                </div>
                                <button type="submit" class="btn btn-danger" name="removeToken">Remove Account</button>
                            <?php } else { ?> 
                                <button type="submit" class="btn btn-primary" name="generateToken">Generate Access Token</button>
                            <?php } ?>

                        </div>
                    </div>
                </form>
            </div>
            <!-- start box body-->
        </div>
        <!-- start box-->
    </div>
    <!--right part -->
</div>