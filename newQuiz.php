<?php 
include 'include/header.php';
include 'proxy/proxy.php';

include 'mailchimp/index.php';
include 'Aweber/demo.php';

if(isset($_REQUEST['quizname'])) {
	if($_FILES['mainpageimage']['name'] != '') {
		$mainImage = uniqid().$_FILES['mainpageimage']['name'];
		$upload2 = 'nimg/'.$mainImage;
		move_uploaded_file($_FILES['mainpageimage']['tmp_name'], $upload2);
	} else {
		$mainImage = $_REQUEST['old_mainpageimage'];
	}

	if($_FILES['mainPageBGImage']['name'] != '') {
		$mainPageBGImage = uniqid().$_FILES['mainPageBGImage']['name'];
		$upload2 = 'nimg/'.$mainPageBGImage;
		move_uploaded_file($_FILES['mainPageBGImage']['tmp_name'], $upload2);
	} else {
		$mainPageBGImage = $_REQUEST['old_mainPageBGImage'];
	}

	if($_FILES['secondpageimage']['name'] != '') {
		$secondpageimage = uniqid().$_FILES['secondpageimage']['name'];
		$upload2 = 'nimg/'.$secondpageimage;
		move_uploaded_file($_FILES['secondpageimage']['tmp_name'], $upload2);
	} else {
		$secondpageimage = $_REQUEST['old_secondpageimage'];
	}


	if($_FILES['secondBGImage']['name'] != '') {
		$secondBGImage = uniqid().$_FILES['secondBGImage']['name'];
		$upload2 = 'nimg/'.$secondBGImage;
		move_uploaded_file($_FILES['secondBGImage']['tmp_name'], $upload2);
	} else {
		$secondBGImage = $_REQUEST['old_secondBGImage'];
	}

	if($_REQUEST['mailchimp-listname'] == '') {
		$listname = $_REQUEST['aweber-listname'];
		$apiname = 'aweber';
	} 
	if($_REQUEST['aweber-listname'] == '') {
		$apiname = 'mailchimp';
		$listname = $_REQUEST['mailchimp-listname'];
	}
	if($_REQUEST['aweber-listname'] == '' && $_REQUEST['mailchimp-listname'] == '') {
		$apiname = $_REQUEST['hid-apiname'];
		$listname = $_REQUEST['hid-listname'];
	}

	//insert into database
	if($_REQUEST['hidden-quiz-id'] == '') {
		$db->query("INSERT INTO `tbl_new_quiz_details`(`quizname`,`quizstyle`,`quiztime`,`excludepage`,`mainpagetext`,`mainPageTextBg`,`mainPageTextFc`,`mainPageTextFs`,`mainPageTextFw`,`mainPageTextFt`,`mainpageimage`,`mainPageDesc`,`mainPageDescBg`,`mainPageDescFc`,`mainPageDescFs`,`mainPageDescFw`,`mainPageDescFt`,`mainPageLButton`,`mainPageRButton`,`mainPageButtonColor`,`mainPageButtonFontColor`,`mainPagebuttonFs`,`mainPagebuttonFw`,`mainPagebuttonFt`,`mainPageBGColor`,`mainPageBGImage`,`mainPageThankYou`,`ThankyouDescBg`,`ThankyouDescFc`,`ThankyouDescFs`,`ThankyouDescFw`,`ThankyouDescFt`,`secondpagetext`,`secondPageTextBg`,`secondPageTextFc`,`secondPageTextFs`,`secondPageTextFw`,`secondPageTextFt`,`secondpageimage`,`secondpagedescription`,`secondPageDescBg`,`secondPageDescFc`,`secondPageDescFs`,`secondPageDescFw`,`secondPageDescFt`,`secondPageLButton`,`secondPageRButton`,`secondPageButtonColor`,`secondPageButtonFontColor`,`secondPagebuttonFs`,`secondPagebuttonFw`,`secondPagebuttonFt`,`secondBGColor`,`secondBGImage`,`SecondThankyoutext`,`SecondThankyouDescBg`,`SecondThankyouDescFc`,`SecondThankyouDescFs`,`SecondThankyouDescFw`,`SecondThankyouDescFt`,`store_name`,`optEmail`,`optBg`,`optFc`,`optFs`,`optFw`,`optFt`,`listname`,`apiname`,`mainoptEmail`,`mainoptBg`,`mainoptFc`,`mainoptFs`,`mainoptFw`,`mainoptFt`) VALUES('".$_REQUEST['quizname']."','".$_REQUEST['quizstyle']."','".$_REQUEST['quiztime']."','".json_encode($_REQUEST['excludepage'])."','".$_REQUEST['mainpagetext']."','".$_REQUEST['mainPageTextBg']."','".$_REQUEST['mainPageTextFc']."','".$_REQUEST['mainPageTextFs']."','".$_REQUEST['mainPageTextFw']."','".$_REQUEST['mainPageTextFt']."','".$mainImage."','".$_REQUEST['mainPageDesc']."','".$_REQUEST['mainPageDescBg']."','".$_REQUEST['mainPageDescFc']."','".$_REQUEST['mainPageDescFs']."','".$_REQUEST['mainPageDescFw']."','".$_REQUEST['mainPageDescFt']."','".$_REQUEST['mainPageLButton']."','".$_REQUEST['mainPageRButton']."','".$_REQUEST['mainPageButtonColor']."','".$_REQUEST['mainPageButtonFontColor']."','".$_REQUEST['mainPagebuttonFs']."','".$_REQUEST['mainPagebuttonFw']."','".$_REQUEST['mainPagebuttonFt']."','".$_REQUEST['mainPageBGColor']."','".$mainPageBGImage."','".$_REQUEST['mainPageThankYou']."','".$_REQUEST['ThankyouDescBg']."','".$_REQUEST['ThankyouDescFc']."','".$_REQUEST['ThankyouDescFs']."','".$_REQUEST['ThankyouDescFw']."','".$_REQUEST['ThankyouDescFt']."','".$_REQUEST['secondpagetext']."','".$_REQUEST['secondPageTextBg']."','".$_REQUEST['secondPageTextFc']."','".$_REQUEST['secondPageTextFs']."','".$_REQUEST['secondPageTextFw']."','".$_REQUEST['secondPageTextFt']."','".$secondpageimage."','".$_REQUEST['secondpagedescription']."','".$_REQUEST['secondPageDescBg']."','".$_REQUEST['secondPageDescFc']."','".$_REQUEST['secondPageDescFs']."','".$_REQUEST['secondPageDescFw']."','".$_REQUEST['secondPageDescFt']."','".$_REQUEST['secondPageLButton']."','".$_REQUEST['secondPageRButton']."','".$_REQUEST['secondPageButtonColor']."','".$_REQUEST['secondPageButtonFontColor']."','".$_REQUEST['secondPagebuttonFs']."','".$_REQUEST['secondPagebuttonFw']."','".$_REQUEST['secondPagebuttonFt']."','".$_REQUEST['secondBGColor']."','".$secondBGImage."','".$_REQUEST['SecondThankyoutext']."','".$_REQUEST['SecondThankyouDescBg']."','".$_REQUEST['SecondThankyouDescFc']."','".$_REQUEST['SecondThankyouDescFs']."','".$_REQUEST['SecondThankyouDescFw']."','".$_REQUEST['SecondThankyouDescFt']."','".$_SESSION['shop']."','".$_REQUEST['optEmail']."','".$_REQUEST['optBg']."','".$_REQUEST['optFc']."','".$_REQUEST['optFs']."','".$_REQUEST['optFw']."','".$_REQUEST['optFt']."','".$listname."','".$apiname."','".$_REQUEST['mainoptEmail']."', '".$_REQUEST['mainoptBg']."','".$_REQUEST['mainoptFc']."','".$_REQUEST['mainoptFs']."','".$_REQUEST['mainoptFw']."','".$_REQUEST['mainoptFt']."')");
		$_SESSION['alert'] = 'Succesfully Added';
		$_SESSION['last_id'] =$db->insert_id;

	}
	//update table in database
	else {


		$db->query("UPDATE tbl_new_quiz_details SET quizname='".$_REQUEST['quizname']."', quiztime='".$_REQUEST['quiztime']."', excludepage='".json_encode($_REQUEST['excludepage'])."', mainpagetext='".$_REQUEST['mainpagetext']."', mainPageTextBg='".$_REQUEST['mainPageTextBg']."', mainPageTextFc='".$_REQUEST['mainPageTextFc']."', mainPageTextFs='".$_REQUEST['mainPageTextFs']."', mainPageTextFw='".$_REQUEST['mainPageTextFw']."', mainPageTextFt='".$_REQUEST['mainPageTextFt']."',mainpageimage='".$mainImage."', mainPageDesc='".$_REQUEST['mainPageDesc']."', mainPageDescBg='".$_REQUEST['mainPageDescBg']."', mainPageDescFc='".$_REQUEST['mainPageDescFc']."', mainPageDescFs='".$_REQUEST['mainPageDescFs']."', mainPageDescFt='".$_REQUEST['mainPageDescFt']."', mainPageLButton='".$_REQUEST['mainPageLButton']."', mainPageRButton='".$_REQUEST['mainPageRButton']."', mainPageButtonColor='".$_REQUEST['mainPageButtonColor']."', mainPageButtonFontColor='".$_REQUEST['mainPageButtonFontColor']."', mainPagebuttonFs='".$_REQUEST['mainPagebuttonFs']."', mainPagebuttonFw='".$_REQUEST['mainPagebuttonFw']."', mainPagebuttonFt='".$_REQUEST['mainPagebuttonFt']."', mainPageBGColor='".$_REQUEST['mainPageBGColor']."', mainPageBGImage='".$mainPageBGImage."', mainPageThankYou='".$_REQUEST['mainPageThankYou']."', ThankyouDescBg='".$_REQUEST['ThankyouDescBg']."', ThankyouDescFc='".$_REQUEST['ThankyouDescFc']."', ThankyouDescFs='".$_REQUEST['ThankyouDescFs']."', ThankyouDescFw='".$_REQUEST['ThankyouDescFw']."', ThankyouDescFt='".$_REQUEST['ThankyouDescFt']."', secondpagetext='".$_REQUEST['secondpagetext']."', secondPageTextBg='".$_REQUEST['secondPageTextBg']."', secondPageTextFc='".$_REQUEST['secondPageTextFc']."', secondPageTextFs='".$_REQUEST['secondPageTextFs']."', secondPageTextFw='".$_REQUEST['secondPageTextFw']."', secondPageTextFt='".$_REQUEST['secondPageTextFt']."', secondpageimage='".$secondpageimage."', secondpagedescription='".$_REQUEST['secondpagedescription']."', secondPageDescBg='".$_REQUEST['secondPageDescBg']."', secondPageDescFc='".$_REQUEST['secondPageDescFc']."', secondPageDescFs='".$_REQUEST['secondPageDescFs']."', secondPageDescFw='".$_REQUEST['secondPageDescFw']."', secondPageDescFt='".$_REQUEST['secondPageDescFt']."', secondPageLButton='".$_REQUEST['secondPageLButton']."', secondPageRButton='".$_REQUEST['secondPageRButton']."', secondPageButtonColor='".$_REQUEST['secondPageButtonColor']."', secondPageButtonFontColor='".$_REQUEST['secondPageButtonFontColor']."', secondPagebuttonFs='".$_REQUEST['secondPagebuttonFs']."', secondPagebuttonFw='".$_REQUEST['secondPagebuttonFw']."', secondPagebuttonFt='".$_REQUEST['secondPagebuttonFt']."', secondBGColor='".$_REQUEST['secondBGColor']."', secondBGImage='".$secondBGImage."', SecondThankyoutext='".$_REQUEST['SecondThankyoutext']."', SecondThankyouDescBg='".$_REQUEST['SecondThankyouDescBg']."', SecondThankyouDescFc='".$_REQUEST['SecondThankyouDescFc']."', SecondThankyouDescFs='".$_REQUEST['SecondThankyouDescFs']."', SecondThankyouDescFw='".$_REQUEST['SecondThankyouDescFw']."', SecondThankyouDescFt='".$_REQUEST['SecondThankyouDescFt']."', optEmail='".$_REQUEST['optEmail']."', optBg='".$_REQUEST['optBg']."', optFc='".$_REQUEST['optFc']."', optFs='".$_REQUEST['optFs']."', optFw='".$_REQUEST['optFw']."', optFt='".$_REQUEST['optFt']."', listname='".$listname."', apiname='".$apiname."',mainoptEmail='".$_REQUEST['mainoptEmail']."',mainoptBg='".$_REQUEST['mainoptBg']."', mainoptFc='".$_REQUEST['mainoptFc']."', mainoptFs='".$_REQUEST['mainoptFs']."', mainoptFw='".$_REQUEST['mainoptFw']."', mainoptFt='".$_REQUEST['mainoptFt']."' WHERE id='".$_REQUEST['hidden-quiz-id']."'");
		$_SESSION['alert'] = 'Succesfully Updated';
	}


}
if(isset($_REQUEST['qid'])) {
	$_SESSION['last_id'] = $_REQUEST['qid'];
}
$fetch = $db->query("SELECT * FROM tbl_new_quiz_details WHERE id='".$_SESSION['last_id']."'");
$QuizDetail = $fetch->fetch_assoc();
?>
<?php if(isset($_SESSION['alert']))  { ?>
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
<div id="CreateQuiz" class="CreateQuiz">
	<div class="col-md-12">
		<!-- start box-->
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Quiz Settings Page</h3>
			</div>
			<!-- start box body-->
			<div class="box-body">
				<form class="form-horizontal" method="post" enctype="multipart/form-data" id="QuizForm">
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button class="btn btn-success" name="SaveQuiz" id="SaveQuiz" type="submit">Save</button>
							<a href="AppMain.php"><span class="btn btn-default BackPage">Back</span></a>
						</div>
					</div>
					<!-- Quiz Name -->
					<div class="form-group">
						<div class="col-md-8 col-md-offset-3"><b>Note :</b> Please use html code <span>&</span>#39; to add an apostrophe to your quiz.</div>
						<label for="quziname" class="col-sm-2 control-label">Quiz Name : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="quizname" name="quizname" placeholder="Enter Quiz Name" value="<?php echo $QuizDetail['quizname'];?>" required>
							<input type="hidden" name="hidden-quiz-id" value="<?php echo $QuizDetail['id'];?>">
						</div>
					</div>
					<!-- end Quiz Name -->
					<!-- Quiz Styles -->
					<pre>
                                <?php
                                print_r($QuizDetail);
                                ?>
                                </pre>
					<?php 
						if($QuizDetail['quizstyle'] == '') { $quizRead = ''; } else { $quizRead ='disabled';} 
						if($QuizDetail['quizstyle'] == 'corner') { $cornerTime = $QuizDetail['quiztime']; $cornerpp = 'checked'; }
						if($QuizDetail['quizstyle'] == 'timedpop') { $timedpopTime = $QuizDetail['quiztime']; $timedpop = 'checked'; }
						if($QuizDetail['quizstyle'] == 'exitintent') { $exitintent = 'checked'; }
					?>
					<div class="form-group">
						<label for="quizstyle" class="col-sm-2 control-label">Quiz Styles : </label>
						<div class="col-sm-8 quizstyle">
							<div class="col-md-3">
								<label>
									<input type="radio" name="quizstyle" id="quizstyle" class="flat-red" value="corner" <?php echo $quizRead;?> <?php echo $cornerpp;?> > Corner Pop
								</label>
								<div class="input-group">
									<input type="number" name="quiztime" class="form-control" value="<?php echo $cornerTime;?>"  min="0">
									<span class="input-group-addon" id="basic-addon1">sec</span>
								</div>
							</div>
							<div class="col-md-3">
								<label>
									<input type="radio" name="quizstyle" <?php echo $timedpop;?> class="flat-red" value="timedpop" <?php echo $quizRead;?>> Timed Pop
								</label>
								<div class="input-group">
									<input type="number" name="quiztime" class="form-control" value="<?php echo $timedpopTime;?>" min="0">
									<span class="input-group-addon" id="basic-addon1">sec</span>
								</div>
							</div>
							<div class="col-md-5">
								<label>
									<input type="radio" name="quizstyle" class="flat-red" <?php echo $exitintent;?> value="exitintent" <?php echo $quizRead;?>>
									Exit Intent (Web Only)
								</label>
							</div>
						</div>
					</div>
					
					<!-- End Quiz Styles -->
					<!-- End Exlcude page-->
					<div class="form-group">
						<label for="answer2" class="col-sm-4 control-label">Exlcude From These Pages : </label>
						<div class="col-sm-3">
							<select multiple class="form-control" name="excludepage[]">
								<?php foreach ($Pagess as $page) { 
									$excludepage = json_decode($QuizDetail['excludepage'],true);
										foreach ($excludepage as $value) {
											if(in_array($value,$page)){
												 $page_select = 'selected';
											}else {
												 $page_select = '';
											}
 										}
 										if(strpos($page['title'],'Home') !==false && $value == 'home') { ?>
											<option value="home" selected><?php echo $page['title'];?></option>
										<?php } else if (strpos($page['title'],'Home') !==false) { ?>	
											<option value="home"><?php echo $page['title'];?></option>
 										<?php } else { ?>
									<option value="<?php echo $page['id'];?>" <?php echo $page_select2;?>><?php echo $page['title'];?></option>
								<?php } }?>
							</select>
						</div>
					</div>
					<!-- End Exlcude page-->
					
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							<div class="row text-center">
								<div class="col-sm-12 text-center"><label>Opt in API Settings</label></div>
								<?php if($api['mailchimp_api_key'] == '' && $api['aweber_acess_token'] == '') { ?>
								<span>Please enter <b>Mailchimp Api Key</b> or <b>Aweber Api Key</b> to activate <b>Email Subscribers</b>.</span>
								<?php } else { ?>
								<div class="col-sm-5">
									<span class="btn btn-default" id="mailchimplist">MailChimp List</span>
								</div>
								<div class="col-sm-2 text-center">OR</div>
								<div class="col-sm-5">
									<span class="btn btn-default" id="aweberlist">Aweber List</span>
								</div>
								<?php } ?> 
								
							</div>
							<div class="col-sm-6 col-sm-offset-3">
								<?php if($QuizDetail['apiname'] == 'mailchimp') { $mailchimp = ''; } else { $mailchimp = 'display:none;'; } ?>
								<div class="mailchimplist" style="margin-top: 5px; <?php echo $mailchimp;?>">
									<input type="hidden" name="hid-listname" value="<?php echo $QuizDetail['listname'];?>">
									<input type="hidden" name="hid-apiname" value="<?php echo $QuizDetail['apiname'];?>">
									<select class="form-control" name="mailchimp-listname">
										<option value="">Select a list</option>
										<?php  foreach ($List['lists'] as  $value) {  
											if($QuizDetail['listname'] == $value['id']) { $mcSelected = 'selected'; } else { $mcSelected = ''; } ?>
										<option value="<?php echo $value['id'];?>" <?php echo $mcSelected;?>><?php echo $value['name'];?></option>
										<?php } ?>
									</select>
								</div>
								<?php if($QuizDetail['apiname'] == 'aweber') { $aweber = ''; } else { $aweber = 'display:none;'; } ?>
								<div class="aweberlist" style="<?php echo $aweber;?> margin-top: 5px;">
									<select class="form-control" name="aweber-listname">
										<option value="">Select a list</option>
										<?php  foreach($account->lists as $offset => $list) { 
										if($QuizDetail['listname'] == $list->id) { $awSelected = 'selected'; } else { $awSelected = ''; } ?>
										<option value="<?php echo $list->id;?>" <?php echo $awSelected;?>><?php echo $list->name;?></option>
										<?php } ?>
									</select>
								</div> 
							</div>
						</div>
					</div>
	

					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							<div class="col-sm-12 text-center"><label>Main Page Background</label></div>
							<div class="col-sm-5">
								<button class="btn btn-default backgroundimage pull-right">Background Color</button>
									<?php if($QuizDetail['mainPageBGColor'] == '') { $bcolor = 'display:none;'; } ?>
									<div class="input-group my-colorpicker2 pull-right" style="margin-top: 5px; <?php echo $bcolor;?>">
									<?php if($QuizDetail['mainPageBGColor'] == '') { ?>
									<input type="text" class="form-control" name="mainPageBGColor" id="mainPageBGColor" value="#ffffff">
									<?php } else { ?>
									<input type="text" class="form-control" name="mainPageBGColor" id="mainPageBGColor" value="<?php echo $QuizDetail['mainPageBGColor'];?>">
									<?php } ?>
									<div class="input-group-addon">
										<i></i>
									</div>
								</div>
							</div>
							<div class="col-sm-2 text-center">OR</div>
							<div class="col-sm-5">
								<button class="btn btn-default backgroundimage">Upload Background</button>
								<?php if($QuizDetail['mainPageBGImage'] == '') { $bimage = 'display:none;'; } else { $bimage = 'hide';} ?>
								<div style="margin-top: 5px; <?php echo $bimage;?>">
									<span class="btn btn-default DeleteImage" style="<?php echo $bimage;?>">Remove Image</span>
									<span></span>
									<img src="nimg/<?php echo $QuizDetail['mainPageBGImage'];?>" class="answerimage" style="<?php echo $bimage;?>">
									<input type="file" class="form-control" id="mainPageBGImage" name="mainPageBGImage" style="margin-top: 5px;">
									<input type="hidden" name="old_mainPageBGImage" value="<?php echo $QuizDetail['mainPageBGImage'];?>">
								</div>
							</div>
						</div>
					</div>
						

					<!-- <h4 class="text-center">Main Page Text</h4> -->
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Headline </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['mainpagetext'] == '') { ?>
							<input type="text" class="form-control text-center" name="mainpagetext" value="Want to save $15? Answer one quick question">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="mainpagetext" value="<?php echo $QuizDetail['mainpagetext'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="mainPageTextBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainPageTextBg'] == '') { ?>
								<input type="text" class="form-control" name="mainPageTextBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainPageTextBg" value="<?php echo $QuizDetail['mainPageTextBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainPageTextFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainPageTextFc'] == '') { ?>
								<input type="text" class="form-control" name="mainPageTextFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainPageTextFc" value="<?php echo $QuizDetail['mainPageTextFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainPageTextFs" class="control-label">Font Size: </label>
							<select name="mainPageTextFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['mainPageTextFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['mainPageTextFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['mainPageTextFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['mainPageTextFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['mainPageTextFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['mainPageTextFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['mainPageTextFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['mainPageTextFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['mainPageTextFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['mainPageTextFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['mainPageTextFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['mainPageTextFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['mainPageTextFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['mainPageTextFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainPageTextFw" class="control-label">Font Weight: </label>
							<select name="mainPageTextFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['mainPageTextFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['mainPageTextFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['mainPageTextFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainPageTextFt" class="control-label">Font Type: </label>
							<select name="mainPageTextFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['mainPageTextFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['mainPageTextFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['mainPageTextFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['mainPageTextFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['mainPageTextFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Image </label>
						</div>
						<div class="col-sm-4 col-sm-offset-4">
							<?php if($QuizDetail['mainpageimage'] != '') { $hidden = 'hide';?>
							<span class="btn btn-default DeleteImage">Remove Image</span>
							<span class="btn btn-default ChangeAnswerImage">Change Image</span>
							<img src="nimg/<?php echo $QuizDetail['mainpageimage'];?>" class="answerimage">
							<?php } ?>
							<input type="file" class="form-control <?php echo $hidden;?>" name="mainpageimage">
							<input type="hidden" class="form-control" name="old_mainpageimage" value="<?php echo $QuizDetail['mainpageimage'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Description </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['mainPageDesc'] == '') { ?>
							<textarea rows="5" cols="100" class="form-control" name="mainPageDesc"></textarea>
							<?php } else { ?>
							<textarea rows="5" cols="100" class="form-control" name="mainPageDesc"><?php echo $QuizDetail['mainPageDesc'];?></textarea>
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="mainPageDescBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainPageDescBg'] == '') { ?>
								<input type="text" class="form-control" name="mainPageDescBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainPageDescBg" value="<?php echo $QuizDetail['mainPageDescBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainPageDescFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainPageDescFc'] == '') { ?>
								<input type="text" class="form-control" name="mainPageDescFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainPageDescFc" value="<?php echo $QuizDetail['mainPageDescFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainPageDescFs" class="control-label">Font Size: </label>
							<select name="mainPageDescFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['mainPageDescFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['mainPageDescFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['mainPageDescFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['mainPageDescFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['mainPageDescFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['mainPageDescFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['mainPageDescFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['mainPageDescFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['mainPageDescFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['mainPageDescFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['mainPageDescFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['mainPageDescFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['mainPageDescFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['mainPageDescFs'] == 'font40') { echo "selected";}?>>40</option>

							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainPageDescFw" class="control-label">Font Weight: </label>
							<select name="mainPageDescFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['mainPageDescFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['mainPageDescFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['mainPageDescFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainPageDescFt" class="control-label">Font Type: </label>
							<select name="mainPageDescFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['mainPageDescFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['mainPageDescFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['mainPageDescFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['mainPageDescFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['mainPageDescFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Button Settings </label>
						</div>
						<div class="col-sm-4 col-sm-offset-2">
							<label for="mainPageLButton" class="control-label">Left Button Text: </label>
							<?php if($QuizDetail['mainPageLButton'] == '') { ?>
							<input type="text" class="form-control text-center" name="mainPageLButton" value="Hack Yes!">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="mainPageLButton" value="<?php echo $QuizDetail['mainPageLButton'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-4">
							<label for="mainPageRButton" class="control-label">Right Button Text: </label>
							<?php if($QuizDetail['mainPageRButton'] == '') { ?>
							<input type="text" class="form-control text-center" name="mainPageRButton" value="No">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="mainPageRButton" value="<?php echo $QuizDetail['mainPageRButton'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="mainPageButtonColor" class="control-label">Button Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainPageButtonColor'] == '') { ?>
								<input type="text" class="form-control" name="mainPageButtonColor" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainPageButtonColor" value="<?php echo $QuizDetail['mainPageButtonColor'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainPageButtonFontColor" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainPageButtonFontColor'] == '') { ?>
								<input type="text" class="form-control" name="mainPageButtonFontColor" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainPageButtonFontColor" value="<?php echo $QuizDetail['mainPageButtonFontColor'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainPagebuttonFs" class="control-label">Font Size: </label>
							<select name="mainPagebuttonFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['mainPagebuttonFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['mainPagebuttonFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['mainPagebuttonFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['mainPagebuttonFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['mainPagebuttonFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['mainPagebuttonFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['mainPagebuttonFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['mainPagebuttonFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['mainPagebuttonFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['mainPagebuttonFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['mainPagebuttonFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['mainPagebuttonFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['mainPagebuttonFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['mainPagebuttonFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainPagebuttonFw" class="control-label">Font Weight: </label>
							<select name="mainPagebuttonFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['mainPagebuttonFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['mainPagebuttonFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['mainPagebuttonFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainPagebuttonFt" class="control-label">Font Type: </label>
							<select name="mainPagebuttonFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['mainPagebuttonFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['mainPagebuttonFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['mainPagebuttonFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['mainPagebuttonFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['mainPagebuttonFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>
					
					
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Opt in Page Text </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['mainoptEmail'] == '') { ?>
							<input type="text" class="form-control text-center" name="mainoptEmail" value="Enter your email to get instant access to your coupon">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="mainoptEmail" value="<?php echo $QuizDetail['mainoptEmail'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="mainoptBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainoptBg'] == '') { ?>
								<input type="text" class="form-control" name="mainoptBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainoptBg" value="<?php echo $QuizDetail['mainoptBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainoptFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['mainoptFc'] == '') { ?>
								<input type="text" class="form-control" name="mainoptFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="mainoptFc" value="<?php echo $QuizDetail['mainoptFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="mainoptFs" class="control-label">Font Size: </label>
							<select name="mainoptFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['mainoptFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['mainoptFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['mainoptFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['mainoptFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['mainoptFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['mainoptFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['mainoptFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['mainoptFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['mainoptFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['mainoptFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['mainoptFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['mainoptFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['mainoptFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['mainoptFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainoptFw" class="control-label">Font Weight: </label>
							<select name="mainoptFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['mainoptFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['mainoptFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['mainoptFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="mainoptFt" class="control-label">Font Type: </label>
							<select name="mainoptFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['mainoptFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['mainoptFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['mainoptFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['mainoptFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['mainoptFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="mainPageThankYou" class="">Main Page Thank You Page </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['mainPageThankYou'] == '') { ?>
							<input type="text" class="form-control text-center" name="mainPageThankYou" value="Enter your email to get instant access to your coupon">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="mainPageThankYou" value="<?php echo $QuizDetail['mainPageThankYou'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="ThankyouDescBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['ThankyouDescBg'] == '') { ?>
								<input type="text" class="form-control" name="ThankyouDescBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="ThankyouDescBg" value="<?php echo $QuizDetail['ThankyouDescBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="ThankyouDescFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['ThankyouDescFc'] == '') { ?>
								<input type="text" class="form-control" name="ThankyouDescFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="ThankyouDescFc" value="<?php echo $QuizDetail['ThankyouDescFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="ThankyouDescFs" class="control-label">Font Size: </label>
							<select name="ThankyouDescFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['ThankyouDescFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['ThankyouDescFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['ThankyouDescFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['ThankyouDescFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['ThankyouDescFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['ThankyouDescFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['ThankyouDescFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['ThankyouDescFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['ThankyouDescFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['ThankyouDescFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['ThankyouDescFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['ThankyouDescFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['ThankyouDescFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['ThankyouDescFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="ThankyouDescFw" class="control-label">Font Weight: </label>
							<select name="ThankyouDescFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['ThankyouDescFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['ThankyouDescFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['ThankyouDescFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="ThankyouDescFt" class="control-label">Font Type: </label>
							<select name="ThankyouDescFt" class="form-control">
							   <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['ThankyouDescFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['ThankyouDescFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['ThankyouDescFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['ThankyouDescFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['ThankyouDescFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>
					<!-- **************Second block************** -->
					<h2 style="margin-top: 100px;" class="text-center">Second Chance Settings</h2>
						
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							<div class="col-sm-12 text-center"><label>Second Chance Background</label></div>
							<div class="col-sm-5">
								<button class="btn btn-default backgroundimage pull-right">Background Color</button>
									<?php if($QuizDetail['secondBGColor'] == '') { $bcolor = 'display:none;'; } ?>
									<div class="input-group my-colorpicker2 pull-right" style="margin-top: 5px; <?php echo $bcolor;?>">
									<?php if($QuizDetail['secondBGColor'] == '') { ?>
									<input type="text" class="form-control" name="secondBGColor" id="secondBGColor" value="#ffffff">
									<?php } else { ?>
									<input type="text" class="form-control" name="secondBGColor" id="secondBGColor" value="<?php echo $QuizDetail['secondBGColor'];?>">
									<?php } ?>
									<div class="input-group-addon">
										<i></i>
									</div>
								</div>
							</div>
							<div class="col-sm-2 text-center">OR</div>
							<div class="col-sm-5">
								<button class="btn btn-default backgroundimage">Upload Background</button>
								<?php if($QuizDetail['secondBGImage'] == '') { $bimage = 'display:none;'; } else { $bimage = 'hide';} ?>
								<div style="margin-top: 5px; <?php echo $bimage;?>">
									<span class="btn btn-default DeleteImage" style="<?php echo $bimage;?>">Remove Image</span>
									<span></span>
									<img src="nimg/<?php echo $QuizDetail['secondBGImage'];?>" class="answerimage" style="<?php echo $bimage;?>">
									<input type="file" class="form-control" id="secondBGImage" name="secondBGImage" style="margin-top: 5px;">
									<input type="hidden" name="old_secondBGImage" value="<?php echo $QuizDetail['secondBGImage'];?>">
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="secondpagetext" class="">Second Chance Headline</label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['secondpagetext'] == '') { ?>
							<input type="text" class="form-control text-center" name="secondpagetext" value="How about $25? Answer one quick question">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="secondpagetext" value="<?php echo $QuizDetail['secondpagetext'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="secondPageTextBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['secondPageTextBg'] == '') { ?>
								<input type="text" class="form-control" name="secondPageTextBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="secondPageTextBg" value="<?php echo $QuizDetail['secondPageTextBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="secondPageTextFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['secondPageTextFc'] == '') { ?>
								<input type="text" class="form-control" name="secondPageTextFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="secondPageTextFc" value="<?php echo $QuizDetail['secondPageTextFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="secondPageTextFs" class="control-label">Font Size: </label>
							<select name="secondPageTextFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['secondPageTextFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['secondPageTextFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['secondPageTextFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['secondPageTextFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['secondPageTextFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['secondPageTextFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['secondPageTextFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['secondPageTextFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['secondPageTextFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['secondPageTextFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['secondPageTextFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['secondPageTextFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['secondPageTextFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['secondPageTextFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="secondPageTextFw" class="control-label">Font Weight: </label>
							<select name="secondPageTextFw" class="form-control"> 
								<option class="light" value="light" <?php if($QuizDetail['secondPageTextFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['secondPageTextFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['secondPageTextFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="secondPageTextFt" class="control-label">Font Type: </label>
							<select name="secondPageTextFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['secondPageTextFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['secondPageTextFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['secondPageTextFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['secondPageTextFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['secondPageTextFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Upload Second Chance Image </label>
						</div>
						<div class="col-sm-4 col-sm-offset-4">
							<?php if($QuizDetail['secondpageimage'] != '') { $hidden = 'hide';?>
							<span class="btn btn-default DeleteImage">Remove Image</span>
							<span class="btn btn-default ChangeAnswerImage">Change Image</span>
							<img src="nimg/<?php echo $QuizDetail['secondpageimage'];?>" class="answerimage">
							<?php } ?>
							<input type="file" class="form-control <?php echo $hidden;?>" name="secondpageimage">
							<input type="hidden" class="form-control" name="old_secondpageimage" value="<?php echo $QuizDetail['secondpageimage'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Second Chance Description </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['secondpagedescription'] == '') { ?>
							<textarea rows="5" cols="100" class="form-control" name="secondpagedescription"></textarea>
							<?php } else { ?>
							<textarea rows="5" cols="100" class="form-control" name="secondpagedescription"><?php echo $QuizDetail['secondpagedescription'];?></textarea>
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="secondPageDescBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['secondPageDescBg'] == '') { ?>
								<input type="text" class="form-control" name="secondPageDescBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="secondPageDescBg" value="<?php echo $QuizDetail['secondPageDescBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="secondPageDescFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['secondPageDescFc'] == '') { ?>
								<input type="text" class="form-control" name="secondPageDescFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="secondPageDescFc" value="<?php echo $QuizDetail['secondPageDescFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="secondPageDescFs" class="control-label">Font Size: </label>
							<select name="secondPageDescFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['secondPageDescFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['secondPageDescFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['secondPageDescFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['secondPageDescFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['secondPageDescFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['secondPageDescFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['secondPageDescFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['secondPageDescFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['secondPageDescFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['secondPageDescFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['secondPageDescFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['secondPageDescFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['secondPageDescFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['secondPageDescFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="secondPageDescFw" class="control-label">Font Weight: </label>
							<select name="secondPageDescFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['secondPageDescFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['secondPageDescFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['secondPageDescFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="secondPageDescFt" class="control-label">Font Type: </label>
							<select name="secondPageDescFt" class="form-control">
								<option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['secondPageDescFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
								<option class="Verdana" value="Verdana" <?php if($QuizDetail['secondPageDescFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
								<option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['secondPageDescFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
								<option class="WildWest" value="WildWest" <?php if($QuizDetail['secondPageDescFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
								<option class="Arial" value="Arial" <?php if($QuizDetail['secondPageDescFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Second Chance Button Settings </label>
						</div>
						<div class="col-sm-4 col-sm-offset-2">
							<label for="secondPageLButton" class="control-label">Left Button Text: </label>
							<?php if($QuizDetail['secondPageLButton'] == '') { ?>
							<input type="text" class="form-control text-center" name="secondPageLButton" value="Hack Yes!">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="secondPageLButton" value="<?php echo $QuizDetail['secondPageLButton'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-4">
							<label for="secondPageRButton" class="control-label">Right Button Text: </label>
							<?php if($QuizDetail['secondPageRButton'] == '') { ?>
							<input type="text" class="form-control text-center" name="secondPageRButton" value="No">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="secondPageRButton" value="<?php echo $QuizDetail['secondPageRButton'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="secondPageButtonColor" class="control-label">Button Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['secondPageButtonColor'] == '') { ?>
								<input type="text" class="form-control" name="secondPageButtonColor" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="secondPageButtonColor" value="<?php echo $QuizDetail['secondPageButtonColor'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="secondPageButtonFontColor" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['secondPageButtonFontColor'] == '') { ?>
								<input type="text" class="form-control" name="secondPageButtonFontColor" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="secondPageButtonFontColor" value="<?php echo $QuizDetail['secondPageButtonFontColor'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="secondPagebuttonFs" class="control-label">Font Size: </label>
							<select name="secondPagebuttonFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['secondPagebuttonFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['secondPagebuttonFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['secondPagebuttonFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['secondPagebuttonFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['secondPagebuttonFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['secondPagebuttonFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['secondPagebuttonFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['secondPagebuttonFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['secondPagebuttonFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['secondPagebuttonFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['secondPagebuttonFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['secondPagebuttonFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['secondPagebuttonFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['secondPagebuttonFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="secondPagebuttonFw" class="control-label">Font Weight: </label>
							<select name="secondPagebuttonFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['secondPagebuttonFw'] == 'light') { echo "selected";}?>>Light</option>
								<option class="normal" value="normal" <?php if($QuizDetail['secondPagebuttonFw'] == 'normal') { echo "selected";}?>>Normal</option>
								<option class="bold" value="bold" <?php if($QuizDetail['secondPagebuttonFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="secondPagebuttonFt" class="control-label">Font Type: </label>
							<select name="secondPagebuttonFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['secondPagebuttonFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['secondPagebuttonFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['secondPagebuttonFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['secondPagebuttonFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['secondPagebuttonFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>



					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Second Chance Opt in Page Text </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['optEmail'] == '') { ?>
							<input type="text" class="form-control text-center" name="optEmail" value="Enter your email to get instant access to your coupon">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="optEmail" value="<?php echo $QuizDetail['optEmail'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="optBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['optBg'] == '') { ?>
								<input type="text" class="form-control" name="optBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="optBg" value="<?php echo $QuizDetail['optBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="optFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['optFc'] == '') { ?>
								<input type="text" class="form-control" name="optFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="optFc" value="<?php echo $QuizDetail['optFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="optFs" class="control-label">Font Size: </label>
							<select name="optFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['optFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['optFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['optFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['optFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['optFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['optFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['optFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['optFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['optFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['optFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['optFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['optFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['optFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['optFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="optFw" class="control-label">Font Weight: </label>
							<select name="optFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['optFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['optFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['optFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="optFt" class="control-label">Font Type: </label>
							<select name="optFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['optFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['optFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['optFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['optFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['optFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Second Chance Thank You Page </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['SecondThankyoutext'] == '') { ?>
							<input type="text" class="form-control text-center" name="SecondThankyoutext" value="Enter your email to get instant access to your coupon">
							<?php } else { ?>
							<input type="text" class="form-control text-center" name="SecondThankyoutext" value="<?php echo $QuizDetail['SecondThankyoutext'];?>">
							<?php } ?>
						</div>
						<div class="col-sm-2 col-sm-offset-1">
							<label for="SecondThankyouDescBg" class="control-label">Text Background Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['SecondThankyouDescBg'] == '') { ?>
								<input type="text" class="form-control" name="SecondThankyouDescBg" value="#f81c1c">
								<?php } else { ?>
								<input type="text" class="form-control" name="SecondThankyouDescBg" value="<?php echo $QuizDetail['SecondThankyouDescBg'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="SecondThankyouDescFc" class="control-label">Font Color: </label>
							<div class="input-group my-colorpicker2">
								<?php if($QuizDetail['SecondThankyouDescFc'] == '') { ?>
								<input type="text" class="form-control" name="SecondThankyouDescFc" value="#000000">
								<?php } else { ?>
								<input type="text" class="form-control" name="SecondThankyouDescFc" value="<?php echo $QuizDetail['SecondThankyouDescFc'];?>">
								<?php } ?>
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<label for="SecondThankyouDescFs" class="control-label">Font Size: </label>
							<select name="SecondThankyouDescFs" class="form-control">
							    <option class="font14" value="font14" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font14') { echo "selected";}?>>14</option>
							    <option class="font16" value="font16" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font16') { echo "selected";}?>>16</option>
							    <option class="font18" value="font18" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font18') { echo "selected";}?>>18</option>
							    <option class="font20" value="font20" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font20') { echo "selected";}?>>20</option>
							    <option class="font22" value="font22" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font22') { echo "selected";}?>>22</option>
							    <option class="font24" value="font24" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font24') { echo "selected";}?>>24</option>
							    <option class="font26" value="font26" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font26') { echo "selected";}?>>26</option>
							    <option class="font28" value="font28" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font28') { echo "selected";}?>>28</option>
							    <option class="font30" value="font30" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font30') { echo "selected";}?>>30</option>
							    <option class="font32" value="font32" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font32') { echo "selected";}?>>32</option>
							    <option class="font34" value="font34" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font34') { echo "selected";}?>>34</option>
							    <option class="font36" value="font36" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font36') { echo "selected";}?>>36</option>
							    <option class="font38" value="font38" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font38') { echo "selected";}?>>38</option>
							    <option class="font40" value="font40" <?php if($QuizDetail['SecondThankyouDescFs'] == 'font40') { echo "selected";}?>>40</option>
							</select>
						</div>
						<div class="col-sm-2">
							<label for="SecondThankyouDescFw" class="control-label">Font Weight: </label>
							<select name="SecondThankyouDescFw" class="form-control">
								<option class="light" value="light" <?php if($QuizDetail['SecondThankyouDescFw'] == 'light') { echo "selected";}?>>Light</option>
							    <option class="normal" value="normal" <?php if($QuizDetail['SecondThankyouDescFw'] == 'normal') { echo "selected";}?>>Normal</option>
							    <option class="bold" value="bold" <?php if($QuizDetail['SecondThankyouDescFw'] == 'bold') { echo "selected";}?>>Bold</option> 
							</select>
						</div>
						<div class="col-sm-2">
							<label for="SecondThankyouDescFt" class="control-label">Font Type: </label>
							<select name="SecondThankyouDescFt" class="form-control">
							    <option class="Times-New-Roman" value="Times-New-Roman" <?php if($QuizDetail['SecondThankyouDescFt'] == 'Times-New-Roman') { echo "selected";}?>>Times New Roman</option>
							    <option class="Verdana" value="Verdana" <?php if($QuizDetail['SecondThankyouDescFt'] == 'Verdana') { echo "selected";}?>>Verdana</option>
							    <option class="Comic-Sans-MS" value="Comic-Sans-MS" <?php if($QuizDetail['SecondThankyouDescFt'] == 'Comic-Sans-MS') { echo "selected";}?>>Comic Sans MS</option>
							    <option class="WildWest" value="WildWest" <?php if($QuizDetail['SecondThankyouDescFt'] == 'WildWest') { echo "selected";}?>>WildWest</option>
							    <option class="Arial" value="Arial" <?php if($QuizDetail['SecondThankyouDescFt'] == 'Arial') { echo "selected";}?>>Arial</option>
							</select>
						</div>
					</div>

					

					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button class="btn btn-success" name="SaveQuiz" id="SaveQuiz" type="submit">Save</button>
							<a href="AppMain.php"><span class="btn btn-default BackPage">Back</span></a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
