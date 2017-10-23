<?php 
include 'include/header.php';
$query = $db->query("SELECT id,quizname,quizstyle FROM tbl_new_quiz_details WHERE store_name='".$_SESSION['shop']."'");
$fetch = $db->query("SELECT id,quizname,quizstyle FROM tbl_new_quiz_details WHERE store_name='".$_SESSION['shop']."'");
?>
<!-- Include Required Prerequisites -->

<div class="row" id="globalSetting">
	<div class="col-md-9 col-md-offset-2">
		<!-- start box-->
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="box-title">Quiz Stats</h3>
			</div>
			<!-- start box body-->
			<div class="box-body">
				<div class="row text-center">
					<div class="col-sm-3">
						<select class="form-control" id="quizStats">
							<option value="all">All</option>
							<?php while($quiz = $query->fetch_array()) { ?>
								<option value="<?php echo $quiz['id'];?>"><?php echo $quiz['quizname'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-2">
						<select class="form-control" id="quizStyle">
							<option value="all">Quiz Style</option>
							<option value="corner">Corner Pop</option>
							<option value="timedpop">Timed Pop</option>
							<option value="exitintent">Exit Intent</option>
						</select>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<input type="hidden" id="shop" value="<?php echo $_SESSION['shop'];?>">
							<input type="text" class="form-control pull-right" id="reservation">
							<!-- <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div> -->
						</div>
					</div>
					<div class="col-sm-3">
						<a id="refreshStats"><span class="btn btn-default">Refresh</span></a>
						<a href="AppMain.php"><span class="btn btn-default">Back</span></a>
					</div>
				</div>			
				<table class="table table-bordered table-hover" id="example2">
					<thead>
						<tr>
							<th>Quiz Name</th>
							<th>Quiz Style</th>
							<th>Views</th>
							<th>Quiz Completions</th>
							<th>Completion %</th>
							<th>Emails Collected</th>
							<th>Email %</th>
						</tr>
					</thead>
					<tbody class="stattable">
						<div class="loader text-center"><i class="fa fa-refresh fa-spin"></i></div>
						<?php 
						while($quiz = mysqli_fetch_array($fetch)) { 
						$data2 = $db->query("SELECT quizstyle, SUM(views) as views, SUM(completions) as completions, SUM(emailcollected) as emailcollected, created FROM tbl_stats WHERE qid='".$quiz['id']."' AND created='".date('Y-m-d')."' GROUP BY quizstyle"); 
								while ($stats = $data2->fetch_array()) {
									$table = 'yes';
									$Views += $stats['views'];
									$completions += $stats['completions'];
									$emailcollected += $stats['emailcollected'];
						?>
							<tr style="text-align: center; <?php echo $style;?>" class="<?php echo 'quiz-'.$quiz['id'];?>">
								<td><?php echo $quiz['quizname'];?> <br> <a data-id="<?php echo $quiz['id'];?>" class="resetStats">Reset Stats</a></td>
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
							<?php } ?>
						<?php }?>
						<?php if($Views) { ?>
						<tr style="text-align: center;">
							<td>Total</td>
							<td></td>
							<td><?php  if($Views) { echo $Views; } else { echo $Views = 0;}?></td>
							<td><?php  if($completions) { echo $completions; } else { echo $completions = 0;}?></td>
							<td><?php echo number_format($completions/$Views*100,2);?>%</td>
							<td><?php  if($emailcollected) { echo $emailcollected; } else { echo $emailcollected = 0;}?></td>
							<td><?php echo number_format($emailcollected/$Views*100,2);?>%</td>
						</tr>	
							<?php } if(!$Views && $table != 'yes' ) { ?>
							<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><b>No Records <?php echo $table;?></b></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
							<?php } ?>
					</tbody>
				</table>	
				<!-- end box body-->
			</div>
			<!-- end box-->
		</div>
	</div>
</div>

<script>
  $(function () {
  	var today = new Date();
  	var dd = today.getDate();
  	var mm = today.getMonth()+1; 
  	var yyyy = today.getFullYear();

  	if(dd<10) {
  		dd='0'+dd
  	} 

  	if(mm<10) {
  		mm='0'+mm
  	} 

  	today = yyyy+'-'+mm+'-'+dd;
  	//document.write(today);
    //Date range picker
    $('#reservation').daterangepicker({
    	locale: {
    		format: 'YYYY-MM-DD'
    	},
    	startDate: today,
    	endDate: today
    });
  });
</script>