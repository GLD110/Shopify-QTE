<?php 
include 'include/header.php';
include 'proxy/proxy.php';
use sandeepshetty\shopify_api;
unset($_SESSION['last_id']);


include 'mailchimp/index.php';
include 'Aweber/demo.php';



$fetch = $db->query("SELECT qd.id,qd.status, qd.quizname,qd.quizstyle,qd.listname,qd.apiname, gs.quiz_percentage,gs.ip_setting FROM tbl_new_quiz_details AS qd LEFT OUTER JOIN tbl_global_setting AS gs ON qd.id = gs.quizid WHERE qd.store_name = '".$_SESSION['shop']."'");
$fetch3 = $db->query("SELECT ip_setting FROM tbl_global_setting WHERE store_name = '".$_SESSION['shop']."' ORDER BY id DESC LIMIT 1");
$ip_setting = $fetch3->fetch_assoc();
$ip_setting = $ip_setting['ip_setting'];

if(isset($_REQUEST['saveSetiing'])) {

	foreach ($_REQUEST['quizid'] as $value => $quizid) {
		$data = $db->query("SELECT quizid FROM tbl_global_setting WHERE quizid ='".$quizid."'");
		if($data->num_rows > 0) {
			$db->query("UPDATE tbl_global_setting SET quiz_percentage='".$_REQUEST['quiz_percentage'][$value]."', ip_setting='".$_REQUEST['ip_setting']."',status='".$_REQUEST['status'][$value]."',store_name='".$_SESSION['shop']."' WHERE quizid = '".$quizid."'");
		} else {
			$db->query("INSERT INTO tbl_global_setting (`quizid`,`quiz_percentage`,`ip_setting`,`store_name`,`status`) VALUES('".$quizid."','".$_REQUEST['quiz_percentage'][$value]."','".$_REQUEST['ip_setting']."','".$_SESSION['shop']."','".$_REQUEST['status'][$value]."')");
		}

		$db->query("UPDATE tbl_new_quiz_details SET status='".$_REQUEST['status'][$value]."' WHERE id='".$quizid."'");
		$_SESSION['alert'] = 'Succesfully Saved';
		//header("Refresh:0");
	}
}
?>
<?php if(isset($_SESSION['alert']))  { 
	$fetch = $db->query("SELECT qd.id,qd.status, qd.quizname,qd.quizstyle,qd.listname,qd.apiname, gs.quiz_percentage,gs.ip_setting FROM tbl_new_quiz_details AS qd LEFT OUTER JOIN tbl_global_setting AS gs ON qd.id = gs.quizid WHERE qd.store_name = '".$_SESSION['shop']."'");
$fetch3 = $db->query("SELECT ip_setting FROM tbl_global_setting WHERE store_name = '".$_SESSION['shop']."' ORDER BY id DESC LIMIT 1");
$ip_setting = $fetch3->fetch_assoc();
$ip_setting = $ip_setting['ip_setting'];
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
<div class="" id="mainPage">
	<div class="col-md-10 col-md-offset-1">
		<!-- start box-->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Main Screen</h3>
			</div>
			<form method="post" id="globalForm">
				<!-- start box body-->
				<div class="box-body">
				<!-- 	<div class="button text-center">
					<a href="CreateQuiz.php"><span class="btn bg-navy margin">Create Quiz</span></a>
					<a href="Stats.php"><span class="btn bg-navy margin">View Stats</span></a>
				</div>  -->
					<div class="col-sm-6">
						<button class="btn btn-primary pull-right globalSave" name="saveSetiing">Save</button>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quiz" class="col-sm-5" style="text-align:right;padding: 5px;">IP Settings : </label>
							<div class="col-sm-4">
								<input type="number" class="form-control" id="quiz" name="ip_setting" value="<?php echo $ip_setting;?>" min="0">
							</div>
							<div class="col-sm-3">
								<span style="position: relative; top: 4px;"><b>24 hrs</b></span>
							</div>
						</div>
					</div>
					<div class="loader text-center"><i class="fa fa-refresh fa-spin"></i></div>
					<table id="example1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Quiz Name</th>
								<th>Quiz Style</th>
								<th>Email List</th>
								<th class="no-sort">Status</th>
								<th class="no-sort">Action</th>
								<th class="no-sort">Rotation</th>
							</tr>
						</thead>
						<tbody>
							<?php while($detail = $fetch->fetch_array()) { 

								?>
							<tr>
								<td><?php echo $detail['quizname'];?></td>
								<td>
									<?php if($detail['quizstyle'] == 'corner') { 
										echo "Corner Pop"; 
									} else if($detail['quizstyle'] == 'timedpop') {
										echo "Timed Pop";
									} else {
										echo "Exit Intent Pop";
									}
									?>
								</td>
								<td>
									<?php 
										if($detail['apiname'] = 'mailchimp') {
											foreach ($List['lists'] as  $value) {
												if($detail['listname'] == $value['id']) { echo "Mailchimp - ".$value['name']; }
											}
										} 
										if($detail['apiname'] = 'aweber') {
											foreach($account->lists as $offset => $list) { 
												if($detail['listname'] == $list->id) { echo "Aweber - ".$list->name; }
											}
										}
									?>
								</td>
								<td>
									<?php if($detail['status'] == 1) { $checked = 'checked'; } else { $checked = '';}?>
									<input type="checkbox" <?php echo $checked;?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Active" data-off="Inactive" value="<?php echo $detail['status'];?>" class="QuizStatus" data-id="<?php echo $detail['id'];?>"> 
								</td>
								<td>
									<span class="btn bg-maroon duplicateQuiz" data-id="<?php echo $detail['id'];?>">Duplicate</span>
									<a href="newQuiz.php?qid=<?php echo $detail['id'];?>"><span class="btn bg-olive">Edit</span></a>
									<span class="btn btn-danger deleteQuiz" data-id="<?php echo $detail['id'];?>">Delete</span>
								</td>
								<td width="15%">
									<div class="input-group">
										<?php if($detail['status'] == 0) { $disable = 'readonly'; } else { $disable = ''; } ?>
										<input type="number" class="form-control checkNumber" id="quiz" name="quiz_percentage[]" <?php echo $disable;?> value="<?php echo $detail['quiz_percentage'];?>" min="0" max="100">
										<input type="hidden" name="quizid[]" value="<?php echo $detail['id'];?>">
										<input type="hidden" name="status[]" class="quizstatus" value="<?php echo $detail['status'];?>">
										<span class="input-group-addon" id="basic-addon1">%</span>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<div class="col-sm-6">
						<button class="btn btn-primary pull-right globalSave" name="saveSetiing">Save</button>
					</div>
					<!-- end box body-->
				</div>
			</form>
		</div>
	</div>
			<!-- end box-->

	</div>
</div>
<?php
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
        ?>
