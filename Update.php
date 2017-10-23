<?php 
header('Access-Control-Allow-Origin: *');
include 'include/DBConnection.php';


if(isset($_REQUEST['quiz_percentage'])) {
	foreach ($_REQUEST['quizid'] as $value => $quizid) {
		$data = $db->query("SELECT quizid FROM tbl_global_setting WHERE quizid ='".$quizid."'");
		if($data->num_rows > 0) {
			$db->query("UPDATE tbl_global_setting SET quiz_percentage='".$_REQUEST['quiz_percentage'][$value]."', ip_setting='".$_REQUEST['ip_setting']."',status='".$_REQUEST['status'][$value]."',store_name='".$_SESSION['shop']."' WHERE quizid = '".$quizid."'");
		} else {
			$db->query("INSERT INTO tbl_global_setting (`quizid`,`quiz_percentage`,`ip_setting`,`store_name`,`status`) VALUES('".$quizid."','".$_REQUEST['quiz_percentage'][$value]."','".$_REQUEST['ip_setting']."','".$_SESSION['shop']."','".$_REQUEST['status'][$value]."')");
		}
	}
	if($db->affected_rows >= 1) {
		echo 1;
		$_SESSION['alert'] = 'Succesfully Saved';
	}
}

if(isset($_REQUEST['setViews'])) {
	$get = $db->query("SELECT views FROM tbl_stats WHERE qid='".$_REQUEST['setViews']."' AND quizstyle='".$_REQUEST['quizstyle']."' AND created='".date("Y-m-d")."'");
	if($get->num_rows > 0) {
		$getData = $get->fetch_assoc();
		$count = $getData['views']+1; 
		$db->query("UPDATE tbl_stats SET views='".$count."' WHERE qid='".$_REQUEST['setViews']."' AND quizstyle='".$_REQUEST['quizstyle']."' AND created='".date("Y-m-d")."'");
	} else {
		$db->query("INSERT INTO tbl_stats (`views`,`quizstyle`,`qid`,`store_name`,`created`) VALUES('1','".$_REQUEST['quizstyle']."','".$_REQUEST['setViews']."','".$_REQUEST['store_name']."','".date("Y-m-d")."')");
	}
}

if(isset($_REQUEST['CompleteQuiz'])) {
	$fetch = $db->query("SELECT completions FROM tbl_stats WHERE qid='".$_REQUEST['CompleteQuiz']."' AND quizstyle='".$_REQUEST['quizstyle']."' AND store_name='".$_REQUEST['store_name']."' AND created='".date('Y-m-d')."'");
	$fetch = $fetch->fetch_assoc();
	$completions = $fetch['completions']+1;
	$db->query("UPDATE tbl_stats SET completions='".$completions."' WHERE qid='".$_REQUEST['CompleteQuiz']."' AND quizstyle='".$_REQUEST['quizstyle']."' AND store_name='".$_REQUEST['store_name']."' AND created='".date('Y-m-d')."'");
}



if(isset($_REQUEST['EmailQuiz'])) {
	$fetch = $db->query("SELECT emailcollected FROM tbl_stats WHERE qid='".$_REQUEST['EmailQuiz']."' AND quizstyle='".$_REQUEST['quizstyle']."' AND store_name='".$_REQUEST['store_name']."' AND created='".date('Y-m-d')."'");
	$fetch = $fetch->fetch_assoc();
	$emailcollected = $fetch['emailcollected']+1;
	$db->query("UPDATE tbl_stats SET emailcollected='".$emailcollected."' WHERE qid='".$_REQUEST['EmailQuiz']."' AND quizstyle='".$_REQUEST['quizstyle']."' AND store_name='".$_REQUEST['store_name']."' AND created='".date('Y-m-d')."'");
}

if(isset($_REQUEST['duplicateid'])) {

	//echo "INSERT INTO `tbl_new_quiz_details` () 
	//SELECT  FROM tbl_new_quiz_details WHERE id='".$_REQUEST['duplicateid']."'";

	$db->query("INSERT INTO `tbl_new_quiz_details` (`quizname`,`quizstyle`,`quiztime`,`excludepage`,`mainpagetext`,`mainPageTextBg`,`mainPageTextFc`,`mainPageTextFs`,`mainPageTextFw`,`mainPageTextFt`,`mainpageimage`,`mainPageDesc`,`mainPageDescBg`,`mainPageDescFc`,`mainPageDescFs`,`mainPageDescFw`,`mainPageDescFt`,`mainPageLButton`,`mainPageRButton`,`mainPageButtonColor`,`mainPageButtonFontColor`,`mainPagebuttonFs`,`mainPagebuttonFw`,`mainPagebuttonFt`,`mainPageBGColor`,`mainPageBGImage`,`mainPageThankYou`,`ThankyouDescBg`,`ThankyouDescFc`,`ThankyouDescFs`,`ThankyouDescFw`,`ThankyouDescFt`,`secondpagetext`,`secondPageTextBg`,`secondPageTextFc`,`secondPageTextFs`,`secondPageTextFw`,`secondPageTextFt`,`secondpageimage`,`secondpagedescription`,`secondPageDescBg`,`secondPageDescFc`,`secondPageDescFs`,`secondPageDescFw`,`secondPageDescFt`,`secondPageLButton`,`secondPageRButton`,`secondPageButtonColor`,`secondPageButtonFontColor`,`secondPagebuttonFs`,`secondPagebuttonFw`,`secondPagebuttonFt`,`secondBGColor`,`secondBGImage`,`SecondThankyoutext`,`SecondThankyouDescBg`,`SecondThankyouDescFc`,`SecondThankyouDescFs`,`SecondThankyouDescFw`,`SecondThankyouDescFt`,`store_name`,`status`,`optEmail`,`optBg`,`optFc`,`optFs`,`optFw`,`optFt`,`listname`,`apiname`) SELECT quizname, quizstyle, quiztime, excludepage, mainpagetext, mainPageTextBg, mainPageTextFc, mainPageTextFs, mainPageTextFw, mainPageTextFt, mainpageimage, mainPageDesc, mainPageDescBg, mainPageDescFc, mainPageDescFs, mainPageDescFw, mainPageDescFt,mainPageLButton, mainPageRButton,mainPageButtonColor, mainPageButtonFontColor , mainPagebuttonFs,mainPagebuttonFw,mainPagebuttonFt,mainPageBGColor, mainPageBGImage, mainPageThankYou, ThankyouDescBg, ThankyouDescFc, ThankyouDescFs, ThankyouDescFw, ThankyouDescFt, secondpagetext, secondPageTextBg, secondPageTextFc, secondPageTextFs, secondPageTextFw, secondPageTextFt, secondpageimage, secondpagedescription, secondPageDescBg, secondPageDescFc, secondPageDescFs, secondPageDescFw, secondPageDescFt, secondPageLButton, secondPageRButton, secondPageButtonColor, secondPageButtonFontColor, secondPagebuttonFs, secondPagebuttonFw, secondPagebuttonFt, secondBGColor, secondBGImage, SecondThankyoutext, SecondThankyouDescBg, SecondThankyouDescFc, SecondThankyouDescFs, SecondThankyouDescFw, SecondThankyouDescFt, store_name,status,optEmail,optBg,optFc,optFs,optFw,optFt,listname,apiname FROM tbl_new_quiz_details WHERE id='".$_REQUEST['duplicateid']."'");
	 $last_id = $db->insert_id;
	$db->query("UPDATE tbl_new_quiz_details SET quizname = CONCAT(quizname,' Copy') WHERE id='".$last_id."'");
	if($db->affected_rows == 1) {
		echo 1;
		$_SESSION['alert'] = 'Succesfully Inserted Duplicate Row';
	}
}
if(isset($_REQUEST['deleteid'])) {
	//$image = $db->query("SELECT answerimage,mainpageimage,backgroundimage FROM tbl_quiz_details WHERE id='".$_REQUEST['deleteid']."'");
	$db->query("DELETE FROM tbl_new_quiz_details WHERE id='".$_REQUEST['deleteid']."'");
	if($db->affected_rows == 1) {
		echo 1;
		$_SESSION['alert'] = 'Succesfully Deleted';
	}
	/*$image = $image->fetch_assoc();
	$AnswerImage = json_decode($image['answerimage'],true);
	unlink('img/'.$image['mainpageimage']);
	unlink('img/'.$image['backgroundimage']);
	foreach ($AnswerImage as $key => $value) {
		foreach ($value as $key => $value2) {
			unlink('img/'.$value2);
		}
	}*/
}
if(isset($_REQUEST['changeStatus'])) {
	$db->query("UPDATE tbl_new_quiz_details SET status='".$_REQUEST['status']."' WHERE id='".$_REQUEST['changeStatus']."'");
	$db->query("UPDATE tbl_global_setting SET status='".$_REQUEST['status']."' WHERE quizid='".$_REQUEST['changeStatus']."'");
}

if(isset($_REQUEST['date'])) {
	$date = explode(' - ',$_REQUEST['date']);
	if($_REQUEST['quizid'] == 'all') {
		$query = $db->query("SELECT id,quizname,quizstyle FROM tbl_new_quiz_details WHERE store_name='".$_REQUEST['shop']."'");
		while($quiz = mysqli_fetch_array($query)) { 
			if($_REQUEST['quizstyle'] == 'all') {
			
				$data2 = $db->query("SELECT quizstyle, SUM(views) as views, SUM(completions) as completions, SUM(emailcollected) as emailcollected, created FROM tbl_stats WHERE qid='".$quiz['id']."' AND created BETWEEN '".$date[0]."' and '".$date[1]."' GROUP BY quizstyle"); 
			} else {
				
				$data2 = $db->query("SELECT quizstyle, SUM(views) as views, SUM(completions) as completions, SUM(emailcollected) as emailcollected, created FROM tbl_stats WHERE qid='".$quiz['id']."' AND created BETWEEN '".$date[0]."' and '".$date[1]."' AND quizstyle='".$_REQUEST['quizstyle']."' GROUP BY quizstyle"); 	
			}


				while ($stats = $data2->fetch_array()) {
						$Views += $stats['views'];
						$completions += $stats['completions'];
						$emailcollected += $stats['emailcollected'];
					?>
					<tr style="text-align: center; <?php echo $style;?>" class="<?php echo 'quiz-'.$quiz['id'];?>">
						<td><?php echo $quiz['quizname'];?><br><a data-id="<?php echo $quiz['id'];?>" class="resetStats">Reset Stats</a></td>
						<td>
							<?php if($stats['quizstyle'] == 'corner') { 
								echo "Corner Pop"; 
							} else if($stats['quizstyle'] == 'timedpop') {
								echo "Timed Pop";
							} else {
								echo "Exit Intent Pop";
							}
							?>
						</td>
						<td><?php echo $stats['views'];?></td>
						<td><?php echo $stats['completions'];?></td>
						<td><?php echo number_format($stats['completions']/$stats['views']*100,2);?>%</td>
						<td><?php echo $stats['emailcollected'];?></td>
						<td><?php echo number_format($stats['emailcollected']/$stats['views']*100,2);?>%</td>
					</tr>
					<?php  } ?>
					<?php }?>
						<?php if($Views) { ?>
						<tr style="text-align: center">
							<td>Total</td>
							<td></td>
							<td><?php  if($Views) { echo $Views; } else { echo $Views = 0;}?></td>
							<td><?php  if($completions) { echo $completions; } else { echo $completions = 0;}?></td>
							<td><?php echo number_format($completions/$Views*100,2);?>%</td>
							<td><?php  if($emailcollected) { echo $emailcollected; } else { echo $emailcollected = 0;}?></td>
							<td><?php echo number_format($emailcollected/$Views*100,2);?>%</td>
						</tr>
						<?php } else { ?>
						<tr style="text-align: center; <?php echo $style;?>" class="<?php echo 'quiz-'.$quiz['id'];?>">
							<td colspan="6"><b>No Records</b></td>
						</tr>
						<?php } ?>
				<?php } else {
					if($_REQUEST['quizstyle'] == 'all') {
						$data2 = $db->query("SELECT quizstyle, SUM(views) as views, SUM(completions) as completions, SUM(emailcollected) as emailcollected FROM tbl_stats WHERE qid='".$_REQUEST['quizid']."' AND created BETWEEN '".$date[0]."' and '".$date[1]."' GROUP BY quizstyle"); 
					}  else {
						$data2 = $db->query("SELECT quizstyle, SUM(views) as views, SUM(completions) as completions, SUM(emailcollected) as emailcollected FROM tbl_stats WHERE qid='".$_REQUEST['quizid']."' AND created BETWEEN '".$date[0]."' and '".$date[1]."' AND quizstyle='".$_REQUEST['quizstyle']."' GROUP BY quizstyle"); 
					}
					if($data2->num_rows > 0) {
						while ($stats = $data2->fetch_array()) {
							?>
							<tr style="text-align: center; <?php echo $style;?>" class="<?php echo 'quiz-'.$quiz['id'];?>">
								<td><?php echo $_REQUEST['quizname']; ?><br><a data-id="<?php echo $_REQUEST['quizid'];?>" class="resetStats">Reset Stats</a></td>
								<td>
									<?php if($stats['quizstyle'] == 'corner') { 
										echo "Corner Pop"; 
									} else if($stats['quizstyle'] == 'timedpop') {
										echo "Timed Pop";
									} else {
										echo "Exit Intent Pop";
									}
									?>
								</td>
								<td><?php echo $stats['views'];?></td>
								<td><?php echo $stats['completions'];?></td>
								<td><?php echo number_format($stats['completions']/$stats['views']*100,2);?>%</td>
								<td><?php echo $stats['emailcollected'];?></td>
								<td><?php echo number_format($stats['emailcollected']/$stats['views']*100,2);?>%</td>
							</tr>
						<?php } 
					} else { ?>
					<tr style="text-align: center; <?php echo $style;?>" class="<?php echo 'quiz-'.$quiz['id'];?>">
						<td colspan="6"><b>No Records</b></td>
					</tr>
				<?php	}
				}
}


if(isset($_REQUEST['resetStats'])) {
	$db->query("UPDATE tbl_stats SET views='0', completions='0', emailcollected='0' WHERE qid='".$_REQUEST['resetStats']."'");
	//echo $db->affected_rows;
	if($db->affected_rows == 1) {
		echo 1;
		$_SESSION['alert'] = 'Succesfully Reset';
	}
}
/*if(isset($_REQUEST['backdeleteImage'])) {
	$image = 'img/'.$_REQUEST['backdeleteImage'];
	if (!unlink($image)) {
		echo ("Error deleting $image");
	}
	else {
		$db->query("UPDATE tbl_quiz_details SET backgroundimage='' WHERE id='".$_REQUEST['id']."'");
		echo "Deleted";
	}
}*/
?>