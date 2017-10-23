<?php 
include 'include/header.php';
//$_SESSION['shop'] = 'adrianapp.myshopify.com';
$fetch = $db->query("SELECT qd.id,qd.status, qd.quizname, gs.quiz_percentage, gs.ip_setting FROM tbl_quiz_details AS qd LEFT OUTER JOIN tbl_global_setting AS gs ON qd.id = gs.quizid WHERE qd.store_name = '".$_SESSION['shop']."'");
if(isset($_REQUEST['saveSetiing'])) {
	foreach ($_REQUEST['quizid'] as $value => $quizid) {
		$data = $db->query("SELECT quizid FROM tbl_global_setting WHERE quizid ='".$quizid."'");
		if($data->num_rows > 0) {
			$db->query("UPDATE tbl_global_setting SET quiz_percentage='".$_REQUEST['quiz_percentage'][$value]."', ip_setting='".$_REQUEST['ip_setting']."',status='".$_REQUEST['status'][$value]."',store_name='".$_SESSION['shop']."' WHERE quizid = '".$quizid."'");
		} else {
			$db->query("INSERT INTO tbl_global_setting (`quizid`,`quiz_percentage`,`ip_setting`,`store_name`,`status`) VALUES('".$quizid."','".$_REQUEST['quiz_percentage'][$value]."','".$_REQUEST['ip_setting']."','".$_SESSION['shop']."','".$_REQUEST['status'][$value]."')");
		}
		$_SESSION['alert'] = 'Succesfully Saved';
		//header("Refresh:0");
	}
}
?>
<?php if(isset($_SESSION['alert']))  { 
$fetch = $db->query("SELECT qd.id,qd.status, qd.quizname, gs.quiz_percentage,gs.ip_setting FROM tbl_quiz_details AS qd LEFT OUTER JOIN tbl_global_setting AS gs ON qd.id = gs.quizid WHERE qd.store_name = '".$_SESSION['shop']."'");

	?>
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"> </i><?php echo $_SESSION['alert']; unset($_SESSION['alert']); ?>
      </div>
    </div>
    <div class="col-sm-4"></div>
  </div>
<?php } ?>
<div class="row" id="globalSetting">
	<div class="col-md-8 col-md-offset-2">
		<!-- start box-->
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="box-title">Global Settings</h3>
			</div>
			<!-- start box body-->
			<div class="box-body">
				<h4>Rotation options. Default is even rotation</h4>
				<form class="form-horizontal" method="post">
					<?php while($quiz = $fetch->fetch_array()) {  $ip_setting = $quiz['ip_setting'];?>
					<div class="form-group">
						<label for="quiz" class="col-sm-2 control-label"><?php echo $quiz['quizname']." :";?> </label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control" id="quiz" name="quiz_percentage[]" value="<?php echo $quiz['quiz_percentage'];?>" min="0">
								<input type="hidden" name="quizid[]" value="<?php echo $quiz['id'];?>">
								<input type="hidden" name="status[]" value="<?php echo $quiz['status'];?>">
								<span class="input-group-addon" id="basic-addon1">%</span>
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="slideup" class="col-sm-2 control-label">Slide UP : </label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control input-width" id="slideup" name="slide_percentage[]" value="<?php echo $quiz['slide_percentage'];?>" min="0">
								<span class="input-group-addon" id="basic-addon1">%</span>
							</div>
						</div>
						<label for="timedpop" class="col-sm-2 control-label">Timed Pop : </label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control input-width" id="timedpop" name="timed_percentage[]" value="<?php echo $quiz['timed_percentage'];?>" min="0">
								<span class="input-group-addon" id="basic-addon1">%</span>
							</div>
						</div>
						<label for="exit" class="col-sm-2 control-label">Exit intent : </label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="number" class="form-control input-width" id="exit" name="exit_percentage[]" value="<?php echo $quiz['exit_percentage'];?>" min="0">
								<span class="input-group-addon" id="basic-addon1">%</span>
							</div>
						</div>
					</div> -->
					<?php } ?>
					<div class="form-group">
						<label for="quiz" class="col-sm-2 control-label">IP Settings : </label>
						<div class="col-sm-2">
							<input type="number" class="form-control" id="quiz" name="ip_setting" value="<?php echo $ip_setting;?>" min="0">
						</div>
						<div class="col-sm-2">
							<span style="position: relative; top: 4px;"><b>24 hrs</b></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button class="btn btn-success" type="submit" name="saveSetiing">Save</button>
							<a href="AppMain.php"><span class="btn btn-default">Back</span></a>
						</div>
					</div>
				</form>
				<!-- end box body-->
			</div>
			<!-- end box-->
		</div>
	</div>
</div>

