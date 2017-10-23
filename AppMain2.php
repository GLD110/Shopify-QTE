<?php 
include 'include/header.php';
include '../proxy/proxy.php';


if(!empty($_REQUEST['protocol'])) {
	$_SESSION['shop']=$_REQUEST['shop'];
	$select_store = $db->query("SELECT * FROM  tbl_usersettings WHERE store_name = '".$_SESSION['shop']."'");
	$result=$select_store->fetch_assoc();
	if($result['paid_plan']==0) { ?>
	<script> 
	top.window.location='https://<?php echo $_SERVER["HTTP_HOST"]; ?>/finalApp/proxy/plan.php?shop=<?php echo strtolower($_REQUEST['shop']); ?>'; 
	</script>
	<?php  }
	else {
		include 'AppMain1.php';
	}
} else {
	$select_store = $db->query("SELECT * FROM  tbl_usersettings WHERE store_name = '".$_REQUEST['shop']."'");
	$_SESSION['shop']=$_REQUEST['shop'];
	$getStore=$select_store->fetch_assoc();
	if(!empty($getStore))
	{ 
		$db->query("DELETE FROM tbl_usersettings WHERE store_name = '".$_REQUEST['shop']."'");
	}
	?>
	<script> window.location.href='https://<?php echo $_SERVER["HTTP_HOST"]; ?>/finalApp/app/appInstall.php?shop=<?php echo strtolower($_REQUEST['shop']); ?>'; </script>

	<?php
}