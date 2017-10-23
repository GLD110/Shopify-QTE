<?php 
include 'include/header.php';
include '../proxy/proxy.php';

//include 'mailchimp/index.php';
//include 'Aweber/demo.php';

$fetch = $db->query("SELECT * FROM tbl_quiz_details WHERE id='".$_REQUEST['qid']."'");
$QuizDetail = $fetch->fetch_assoc();

if(isset($_REQUEST['quizname'])) {
	$optcode = str_replace("'","[:::]",$_REQUEST['optcode']);

	if($optcode == '') {
		$optcode = $QuizDetail['optcode'];
	}
	$AnswerImage = array_values($_FILES['answerimage']['name']);
	$AnswerImageTemp = array_values($_FILES['answerimage']['tmp_name']);
	$old_image = array_values($_REQUEST['old_image']);
	$answer = array_values($_REQUEST['answer']);
	for($i = 0; $i < count($AnswerImage); $i++) {
		for($j = 0; $j < count($AnswerImage[$i]); $j++) {
			if($AnswerImage[$i][$j] != '') {
				$AnswerImage[$i][$j] = uniqid()."_".$AnswerImage[$i][$j];
			} 
			if($AnswerImage[$i][$j] == '') {
				$AnswerImage[$i][$j] = $old_image[$i][$j];
			}
			$image_path="img/".$AnswerImage[$i][$j];
			move_uploaded_file($AnswerImageTemp[$i][$j], $image_path);
		}
	}
	if($_FILES['backgroundimage']['name'] != '') {
		$backImage = uniqid().$_FILES['backgroundimage']['name'];
		$upload = 'img/'.$backImage;
		move_uploaded_file($_FILES['backgroundimage']['tmp_name'], $upload);
	} else {
		$backImage = $_REQUEST['old_back_image'];
	}
	if($_FILES['mainpageimage']['name'] != '') {
		$mainImage = uniqid().$_FILES['mainpageimage']['name'];
		$upload2 = 'img/'.$mainImage;
		move_uploaded_file($_FILES['mainpageimage']['tmp_name'], $upload2);
	} else {
		$mainImage = $_REQUEST['old_mainpageimage'];
	}

	/*if($_REQUEST['mailchimp-listname'] == '') {
		$listname = $_REQUEST['aweber-listname'];
		$apiname = 'aweber';
	} else if ($_REQUEST['mailchimp-listname'] == ''){
		$apiname = '';
	} else {
		$apiname = 'mailchimp';
		$listname = $_REQUEST['mailchimp-listname'];
	}*/
	/*update page*/
	$page_id = $_REQUEST['thankyou_id'];
	$post_page = array(
		"page"=> array(
			"title"=> "Thank you",
			"body_html"=> $_REQUEST['opttextafter']
			)
		);
	//$post = $shopify("PUT /admin/pages/$page_id.json",$post_page);
	/*update page*/
	$db->query("UPDATE tbl_quiz_details SET quizname='".$_REQUEST['quizname']."',quizstyle='".$_REQUEST['quizstyle']."',slidetime='".$_REQUEST['slidetime']."',timedpoptime='".$_REQUEST['timedpoptime']."',buttoncolor='".$_REQUEST['buttoncolor']."',fontcolor='".$_REQUEST['fontcolor']."',question='".json_encode(array_values($_REQUEST['question']))."',questionstyle='".json_encode(array_values($_REQUEST['questionstyle']))."',answer='".json_encode($answer)."',answerimage='".json_encode($AnswerImage)."',excludepage='".json_encode($_REQUEST['excludepage'])."',mainpagetext='".$_REQUEST['mainpagetext']."', opttextbefore='".$_REQUEST['opttextbefore']."',opttextafter='".$_REQUEST['opttextafter']."',pbar='".$_REQUEST['pbar']."', backgroundimage='".$backImage."',backgroundcolor='".$_REQUEST['backgroundcolor']."',color='".$_REQUEST['color']."', mainpageimage='".$mainImage."', description='".$_REQUEST['description']."', mainbuttontext='".$_REQUEST['mainbuttontext']."', optcode='".$optcode."' WHERE id='".$_REQUEST['qid']."'");
	$_SESSION['alert'] = 'Succesfully Update';
	$_SESSION['last_id'] = $_REQUEST['qid'];
	//header("Refresh:0");
}
?>
<?php 
if(!empty($_SESSION['last_id'])) { 
	$fetch = $db->query("SELECT * FROM tbl_quiz_details WHERE id='".$_SESSION['last_id']."'");
	$QuizDetail = $fetch->fetch_assoc();
} ?>
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
<div id="CreateQuiz">
	<div class="col-md-12">
		<!-- start box-->
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Edit Quiz Settings Page</h3>
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
						<label for="quziname" class="col-sm-2 control-label">Quiz Name : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="quizname" name="quizname" placeholder="Enter Quiz Name" value="<?php echo $QuizDetail['quizname'];?>" required>
						</div>
					</div>
					<!-- end Quiz Name -->
					<!-- Quiz Styles -->
					<!-- <div class="form-group">
						<label for="quizstyle" class="col-sm-2 control-label">Quiz Styles : </label>
						<div class="col-sm-8 quizstyle">
							<div class="col-md-3">
								<label>
									<?php if($QuizDetail['quizstyle'] == 'corner') { $slideup = 'checked'; $disabled = ''; } else { $disabled = 'disabled'; } ?>
									<input type="radio" name="quizstyle" id="quizstyle" class="flat-red" <?php echo $slideup;?> value="corner"> Corner Pop
								</label>
								<div class="input-group">
									<input type="number" name="slidetime" class="form-control"  value="<?php echo $QuizDetail['slidetime'];?>" <?php echo $disabled;?> min="0">
									<span class="input-group-addon" id="basic-addon1">sec</span>
								</div>
							</div>
							<div class="col-md-3">
								<label>
									<?php if($QuizDetail['quizstyle'] == 'timedpop') { $timedpop = 'checked'; $disabled2 = ''; } else { $disabled2 = 'disabled'; }  ?>
									<input type="radio" name="quizstyle" class="flat-red" value="timedpop" <?php echo $timedpop;?>> Timed Pop
								</label>
								<div class="input-group">
									<input type="number" name="timedpoptime" class="form-control" value="<?php echo $QuizDetail['timedpoptime'];?>" <?php echo $disabled2;?> min="0">
									<span class="input-group-addon" id="basic-addon1">sec</span>
								</div>
							</div>
							<div class="col-md-3">
								<label>
									<?php if($QuizDetail['quizstyle'] == 'exitintent') { $exitintent = 'checked'; } ?>
									<input type="radio" name="quizstyle" class="flat-red" value="exitintent" <?php echo $exitintent;?>>
									Exit Intent
								</label>
							</div>
						</div>
					</div> -->
					<!-- End Quiz Styles -->
					<!--Quiz Apperance -->
					<div class="form-group">
						<h4><label for="buttoncolor" class="col-sm-2 control-label">Quiz Apperance</label></h4>
					</div>
					<div class="form-group">
						<label for="buttoncolor" class="col-sm-2 control-label">Button Color : </label>
						<div class="col-sm-2">
							<div class="input-group my-colorpicker2">
								<input type="text" class="form-control" name="buttoncolor" value="<?php echo $QuizDetail['buttoncolor'];?>">
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<!-- <label for="buttoncolor" class="col-sm-2 control-label">Color : </label>
						<div class="col-sm-2">
							<div class="input-group my-colorpicker2">
								<input type="text" class="form-control" name="color" value="<?php echo $QuizDetail['color'];?>">
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div> -->
					</div>
					<div class="form-group">
						<label for="fontcolor" class="col-sm-2 control-label">Font Color : </label>
						<div class="col-sm-2">
							<div class="input-group my-colorpicker2">
								<input type="text" class="form-control" name="fontcolor" value="<?php echo $QuizDetail['fontcolor'];?>">
								<div class="input-group-addon">
									<i></i>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-sm-offset-1">
							<div class="col-sm-4">
								<button class="btn btn-default backgroundimage">Background Color</button>
								<?php if($QuizDetail['backgroundcolor'] == '') { $bcolor = 'display:none;'; } ?>
								<div class="input-group my-colorpicker2" style="margin-top: 5px; <?php echo $bcolor;?>">
									<input type="text" class="form-control" name="backgroundcolor" id="backgroundcolor" value="<?php echo $QuizDetail['backgroundcolor'];?>">
									<div class="input-group-addon">
										<i></i>
									</div>
								</div>
							</div>
							<div class="col-sm-1">OR</div>
							<div class="col-sm-7">
								<button class="btn btn-default backgroundimage">Upload Background</button>
								<?php if($QuizDetail['backgroundimage'] == '') { $bimage = 'display:none;'; } else { $bimage = 'hide';} ?>
								<div style="margin-top: 5px; <?php echo $bimage;?>">
									<span class="btn btn-default DeleteImage" style="<?php echo $bimage;?>">Remove Image</span>
									<span></span>
									<img src="img/<?php echo $QuizDetail['backgroundimage'];?>" class="answerimage" style="<?php echo $bimage;?>">
									<input type="file" class="form-control" id="backgroundimage" name="backgroundimage" style="margin-top: 5px;">
									<input type="hidden" name="old_back_image" value="<?php echo $QuizDetail['backgroundimage'];?>">
								</div>
							</div>
						</div>
					</div>
					<!-- End Quiz Apperance -->
					<!-- Quiz Questions-->
					<div class="Question-details">
						<?php 
							$question = json_decode($QuizDetail['question'],true);
							$questionstyle = json_decode($QuizDetail['questionstyle'],true);
							$answer = json_decode($QuizDetail['answer'],true);
							$answerimage = json_decode($QuizDetail['answerimage'],true);
							$i = 0;
							if(count($question) == 0) { ?>
							<div class="Questions">
								<div class="Question-form">
									<div class="form-group">
										<label for="question" class="col-sm-2 control-label">Question : </label>
										<div class="col-sm-8">
											<input type="text" class="form-control question" id="question" name="question[]" placeholder="Enter Question" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"></label>
										<div class="col-sm-8">
											<input type="radio" name="questionstyle[]" checked value="button"> Buttons
										</div>	
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"></label>
										<div class="col-sm-8">
											<input type="radio" name="questionstyle[]" value="dropdown"> Dropdown
										</div>
									</div>
									<div class="form-group">
										<label for="answer1" class="col-sm-2 control-label">Answer : </label>
										<div class="col-sm-4">
											<input type="text" class="form-control answer" id="answer1" name="answer[0][]" placeholder="Enter Answer">
										</div>
										<div class="col-sm-4">
											<input type="file" class="form-control" id="answer2" name="answerimage[0][]" placeholder="Enter Answer">
										</div>
									</div>
									<div class="form-group">
										<label for="answer2" class="col-sm-2 control-label">Answer : </label>
										<div class="col-sm-4">
											<input type="text" class="form-control answer" id="answer2" name="answer[0][]" placeholder="Enter Answer">
										</div>
										<div class="col-sm-4">
											<input type="file" class="form-control" id="answer2" name="answerimage[0][]" placeholder="Enter Answer">
										</div>
									</div>
									<div class="append-answer"></div>
									<div class="row col-sm-offset-2">
										<button class="btn bg-purple margin add-answer">Add More Answers</button>
									</div>
								</div>
							</div>
						<?php } else {
							foreach ($question as $key => $Question) {
						?>
						<div class="Questions">
							<div class="Question-form">
								<div class="form-group">
									<label for="question" class="col-sm-2 control-label">Question : </label>
									<div class="col-sm-8">
										<input type="text" class="form-control question" id="question" name="question[<?php echo $i;?>]" placeholder="Enter Question" value="<?php echo $Question;?>">
									</div>
									<div class="col-sm-2">
										<button class="btn btn-danger remove-button"><i class="fa fa-fw fa-times-circle"></i></button>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-8">
										<input type="radio" name="questionstyle[<?php echo $i;?>]" <?php if($questionstyle[$key] == 'button') { echo 'checked'; } ?> value="button"> Buttons
									</div>	
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-8">
										<input type="radio" name="questionstyle[<?php echo $i;?>]" value="dropdown" <?php if($questionstyle[$key] == 'dropdown') { echo 'checked'; } ?>> Dropdown
									</div>
								</div>
								<?php $p = 0; foreach ($answer[$key] as $key2 => $value) { ?>
								<div class="form-group">
									<label for="answer1" class="col-sm-2 control-label">Answer : </label>
									<div class="col-sm-4">
										<input type="text" class="form-control answer" id="answer1" name="answer[<?php echo $i;?>][]" placeholder="Enter Answer" value="<?php echo $value;?>">
									</div>
									<div class="col-sm-4">
									<?php  if($answerimage[$key][$key2] != '') { $hide = 'hide'; ?>
										<span class="btn btn-default DeleteImage">Remove Image</span>
										<span class="btn btn-default ChangeAnswerImage">Change Image</span>
										<img src="img/<?php echo $answerimage[$key][$key2];?>" class="answerimage">
									<?php } else { $hide = 'show'; } ?>
										<input type="file" class="form-control <?php echo $hide;?>" id="answer2" name="answerimage[<?php echo $i;?>][]" placeholder="Enter Answer">
										<input type="hidden" name="old_image[<?php echo $i;?>][]" value="<?php echo $answerimage[$key][$key2];?>">
									</div>
									<?php if($p >=2) { ?>
									<div class="">
										<div class="col-sm-2">
											<button class="btn btn-danger remove-button"><i class="fa fa-fw fa-times-circle"></i></button>
										</div>
									</div>
									<?php } ?>
								</div>
								
								<?php $p++; } ?>
								<div class="append-answer"></div>
								<div class="row col-sm-offset-2">
									<button class="btn bg-purple margin add-answer">Add More Answers</button>
								</div>
							</div>
						</div>
						<?php $i++; } } ?>
					</div>
					<div class="row col-sm-offset-2">
						<button class="btn bg-maroon margin add-questions">Add More Questions</button>
					</div>
					<!-- End Quiz Questions-->
					<!-- End Progress bar-->
					<div class="form-group">
						<label for="answer2" class="col-sm-2 control-label">Progress Bar : </label>
						<div class="col-sm-8">
							<label class="checkbox-inline">
								<input type="checkbox" name="pbar" <?php if($QuizDetail['pbar'] == 1) { echo "checked";}?> data-toggle="toggle" value="<?php echo $QuizDetail['pbar'];?>">
							</label>
						</div>
					</div>
					<!-- End Progress bar-->
					<!-- End Exlcude page-->
					<div class="form-group">
						<label for="answer2" class="col-sm-4 control-label">Exlcude From These Pages : </label>
						<div class="col-sm-3">
							<select multiple class="form-control" name="excludepage[]">
								<?php foreach ($Pagess as $page) { 
									$excludepage = json_decode($QuizDetail['excludepage'],true);
										foreach ($excludepage as $value) {
											if($page['title'] == 'Thank you') {
												$thankyou_id = $page['id'];
											}
											if(in_array($value,$page)){
												 $page_select = 'selected';
											}   else {
												 $page_select = '';
											}
 										}
									if(strpos($page['title'],'Home') !==false) { ?>
											<option value="home" <?php echo $page_select;?> <?php ?>><?php echo $page['title'];?></option>
 										<?php } else { ?>
									<option value="<?php echo $page['id'];?>" <?php echo $page_select;?>><?php echo $page['title'];?></option>
								<?php } }?>
							</select>
						</div>
					</div>
					<!-- End Exlcude page-->
					<!-- End Main Page Text-->
					<!-- <h4 class="text-center">Main Page Text</h4> -->
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Text </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<input type="text" class="form-control text-center" name="mainpagetext" value="<?php echo $QuizDetail['mainpagetext'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Image </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<?php if($QuizDetail['mainpageimage'] != '') { $hidden = 'hide';?>
							<span class="btn btn-default DeleteImage">Remove Image</span>
							<span class="btn btn-default ChangeAnswerImage">Change Image</span>
							<img src="img/<?php echo $QuizDetail['mainpageimage'];?>" class="answerimage">
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
							<textarea rows="5" cols="100" class="form-control" name="description" required><?php echo $QuizDetail['description'];?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Main Page Button Text </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<input type="text" class="form-control text-center" name="mainbuttontext" value="<?php echo $QuizDetail['mainbuttontext'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Opt in code </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<textarea rows="10" cols="100" class="form-control" name="optcode" id="optcode"></textarea>
							<?php if($QuizDetail['optcode'] !='') { ?>
							<div class="code-preview">
								<div class="text-center"><b>Opt Code Preview</b></div>
								<?php echo "<pre>";print_r(htmlspecialchars($QuizDetail['optcode']));echo "</pre>";?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">Opt in Page Text </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<input type="text" class="form-control text-center" name="opttextbefore" value="<?php echo $QuizDetail['opttextbefore'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<label for="answer2" class="">After Opt in Text </label>
						</div>
						<div class="col-sm-8 col-sm-offset-2">
							<input type="hidden" name="thankyou_id" value="<?php echo $thankyou_id;?>">
							<textarea class="form-control text-center" name="opttextafter"><?php echo $QuizDetail['opttextafter'];?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button class="btn btn-success" name="SaveQuiz" id="SaveQuiz" type="submit">Save</button>
							<a href="AppMain.php"><span class="btn btn-default BackPage">Back</span></a>
						</div>
					</div>
					<!-- End Main Page Text-->
				</form>
				<!-- end box body-->
			</div>
			<!-- end box-->
		</div>
	</div>
</div>