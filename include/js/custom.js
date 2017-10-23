 $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "aoColumnDefs": [
      { 'bSortable': false, 'aTargets': [ 3 ] },
      { 'bSortable': false, 'aTargets': [ 4 ] },
      { 'bSortable': false, 'aTargets': [ 5 ] }
      ]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "pageLength":10,
      "order": [[ 3, "asc" ]]
    });
   
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    $(".my-colorpicker2").colorpicker();
    $('.add-questions').click(function(e){
      e.preventDefault();
      var index = $('.Questions').length;
      var question = '<div class="Questions"><div class="marginTop"><div class="form-group"><label for="question" class="col-sm-2 control-label">Question : </label><div class="col-sm-8"><input type="text" class="form-control" id="question" name="question[]" placeholder="Enter Question"></div><div class="col-sm-2"><button class="btn btn-danger remove-button"><i class="fa fa-fw fa-times-circle"></i></button></div></div><div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-8"><input type="radio" name="questionstyle['+index+']" checked value="button"> Buttons</div></div><div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-8"><input type="radio" name="questionstyle['+index+']" value="dropdown"> Dropdown</div></div><div class="form-group"><label for="answer1" class="col-sm-2 control-label">Answer : </label><div class="col-sm-4"><input type="text" class="form-control answer" id="answer1" name="answer['+index+'][]" placeholder="Enter Answer"></div><div class="col-sm-4"><input type="file" class="form-control" id="answer2" name="answerimage['+index+'][]" placeholder="Enter Answer"></div></div><div class="form-group"><label for="answer2" class="col-sm-2 control-label">Answer : </label><div class="col-sm-4"><input type="text" class="form-control" id="answer2" name="answer['+index+'][]" placeholder="Enter Answer"></div><div class="col-sm-4"><input type="file" class="form-control answer" id="answer2" name="answerimage['+index+'][]" placeholder="Enter Answer"></div></div><div class="append-answer"></div><div class="row col-sm-offset-2"><button class="btn bg-purple margin add-answer">Add More Answers</button></div></div></div>';
        $(this).parent().prev().append(question);
    });
    $('body').on('click','.add-answer',function(e){
      e.preventDefault();
      var index = $(this).parent().parent().parent().index();
        var answer = '<div class="Answers"><div class="form-group"><label for="answer2" class="col-sm-2 control-label">Answer : </label><div class="col-sm-4"><input type="text" class="form-control answer" id="answer2" name="answer['+index+'][]" placeholder="Enter Answer"></div><div class="col-sm-4"><input type="file" class="form-control" id="answer2" name="answerimage['+index+'][]" placeholder="Enter Answer"></div><div class="col-sm-2"><button class="btn btn-danger remove-button"><i class="fa fa-fw fa-times-circle"></i></button></div></div></div>';
        $(this).parent().prev().append(answer);
    });
    setTimeout(function(){
      $('.toggle-group>label').click(function(){
       if($(this).parent().parent().parent().parent().find('.checkNumber').attr('readonly')) {
        $(this).parent().parent().parent().parent().find('.checkNumber').removeAttr('readonly');
      } else {
        $(this).parent().parent().parent().parent().find('.checkNumber').attr('readonly',true);
      }
        if($(this).text() == 'Off' || $(this).text() == 'Inactive') {
          $(this).parent().prev().val(1);
           $(this).parent().parent().parent().parent().find('.quizstatus').val(1);
        }
        else {
          alert('Please change rotation of active quizzes.');
          $(this).parent().prev().val(0);
           $(this).parent().parent().parent().parent().find('.quizstatus').val(0);
        }
      });


      $('.toggle-group>span').click(function(){
       if($(this).parent().parent().parent().parent().find('.checkNumber').attr('readonly')) {
        $(this).parent().parent().parent().parent().find('.checkNumber').removeAttr('readonly');
      } else {
        $(this).parent().parent().parent().parent().find('.checkNumber').attr('readonly',true);
      }
        if($(this).parent().parent().attr('class').search('btn-danger') > 0) {
          $(this).parent().prev().val(1);
           $(this).parent().parent().parent().parent().find('.quizstatus').val(1);
        }
        else {
          alert('Please change rotation of active quizzes.');
          $(this).parent().prev().val(0);
           $(this).parent().parent().parent().parent().find('.quizstatus').val(0);
        }
      });
    },500);
    $('body').on('click','.remove-button',function(e){
      e.preventDefault();
      $(this).parent().parent().parent().remove();
    });
    /*$('#SaveQuiz').click(function(e){
        var a = confirm("Are you sure you want to save this quiz?");
        if(a == false) {
          e.preventDefault();
        } 
    });*/
    /*$('#SaveQuiz').click(function(e){
      e.preventDefault();
      $('input[type="text"]').css('border-color','#d2d6de');
      $('input[type="file"]').css('border-color','#d2d6de');
      var check = '';
      $('input.answer').each(function(){
        if($(this).val() != '' && $(this).parent().next().children().val() !='') {
          check = 1;
          $(this).css('border-color','red');
          $(this).parent().next().children().css('border-color','red');
          return false;
        }
        else if ($(this).val() == '' && $(this).parent().next().children().val() =='') {
          check = 2;
          $(this).css('border-color','red');
          $(this).parent().next().children().css('border-color','red');
          return false;
        }
        return check;
      });
      $('input.question').each(function(){
        if($(this).val() == '') {
          check = 3;
           $(this).css('border-color','red');
          return false;
        }
        return check;
      });
      if($('#quizname').val() == '') {
        $('#quizname').css('border-color','red');
        alert('Please enter Quiz name.');
      }
      else if(check == 1 || check == 2) {
        alert('Please fill answer or upload image.');
      } else if ($('#backgroundcolor').val() != '' && $('#backgroundimage').val() != ''){
        alert('Please select either background color or background image');
          $('#backgroundcolor').css('border-color','red');
          $('#backgroundimage').css('border-color','red');
          $('#backgroundimage').val('');
           $('#backgroundcolor').val('#ffffff');
      } else if(check == 3) {
           alert('Please enter Question.');
      } else if($('.mainpageimage').val() == '') {
          $('.mainpageimage').css('border-color','red');
          alert('Please select a image');
      } else {
        $(this).text('Loading...');
        $('#QuizForm').submit();
      }
    });*/
    $('.duplicateQuiz').click(function(){
      var id = $(this).data('id');
      $.ajax({
          type:"POST",
          url:"Update.php",
          data:"duplicateid="+id,
          success:function(data){
              console.log(data);
              if(data == 1) {
                window.location.reload();
              }
          }
      });
    });

    $('.deleteQuiz').click(function(){
      var id = $(this).data('id');
      var x = confirm("Are you sure you want to delete this quiz?");
      if(x == true) {
      	$.ajax({
      		type:"POST",
      		url:"Update.php",
      		data:"deleteid="+id,
      		success:function(data){
      			if(data == 1) {
      				window.location.reload();
      			}
      		}
      	});
      }
    });
    $('#CreateQuiz .iCheck-helper:eq(0)').click(function(){
      $('.quizstyle input[type="number"]:eq(0)').removeAttr('disabled');
      $('.quizstyle input[type="number"]:eq(1)').attr('disabled',true);
    }); 
    $('#CreateQuiz .iCheck-helper:eq(1)').click(function(){
        $('.quizstyle input[type="number"]:eq(0)').attr('disabled',true);
        $('.quizstyle input[type="number"]:eq(1)').removeAttr('disabled');
    }); 
     $('#CreateQuiz .iCheck-helper:eq(2)').click(function(){
        $('.quizstyle input[type="number"]:eq(0)').attr('disabled',true);
        $('.quizstyle input[type="number"]:eq(1)').attr('disabled',true);
    }); 
   /* setTimeout(function(){
      $('td .toggle-group>label').click(function(){
        var id = $(this).parent().prev().data('id');
        var status = $(this).parent().prev().val();
        if($(this).parent().parent().parent().parent().find('.checkNumber').attr('readonly')) {
          $(this).parent().parent().parent().parent().find('.checkNumber').removeAttr('readonly');
        } else {
          $(this).parent().parent().parent().parent().find('.checkNumber').attr('readonly',true);
        }
        $('.loader').show();
        $.ajax({
          type:"POST",
          url:"Update.php",
          data:"changeStatus="+id+"&status="+status,
          success:function(data){
          	 $('.loader').fadeOut(1000);
            console.log(data);
          }
        });
      });
    },500);*/

    $('.ChangeAnswerImage').click(function(){
      $(this).hide();
      $(this).next().hide();
      $(this).next().next().removeClass('hide');
    });
  $('.backgroundimage').click(function(e){
    e.preventDefault();
    $(this).next().toggle();
  });
  $('#mailchimplist').click(function(e) {
    e.preventDefault();
    $('.aweberlist').hide();
    $('.mailchimplist select').attr('disabled',false);
    $('.aweberlist select').attr('disabled',true);
    $('.mailchimplist').toggle();
  });
   $('#aweberlist').click(function(e) {
    e.preventDefault();
    $('.aweberlist select').attr('disabled',false);
    $('.mailchimplist select').attr('disabled',true);
    $('.mailchimplist').hide();
    $('.aweberlist').toggle();
  });
   $('#changeopt').click(function(){
      $('#optcode').toggle();
      $('.code-preview').toggle();
   });
   $('.DeleteImage').click(function(){
      $(this).next().next().css('display','none');
      $(this).next().next().next().next().val('');
   });
   $('#quizStats').change(function(){
      var id = '.quiz-'+$(this).val();
      var quizid = $(this).val();
      var date = $('#reservation').val();
      var quizstyle = $('#quizStyle option:selected').val();
      var quizname = $('#quizStats option:selected').text();
        if(date == undefined || date == null || date =='') {
         $('.stattable tr').hide();
         $('.stattable tr'+id).css('display','table-row');
         //GetStats(date,id,quizname);
       } else {
          $('.loader').toggle();
          GetStats(date,quizid,quizname,quizstyle);
       }
   });

   $('#quizStyle').change(function(){
      var quizstyle = $(this).val();
      var quizid = $('#quizStats option:selected').val();
      var date = $('#reservation').val();
      var quizname = $('#quizStats option:selected').text();
        if(date == undefined || date == null || date =='') {
         $('.stattable tr').hide();
         $('.stattable tr'+id).css('display','table-row');
         //GetStats(date,id,quizname);
       } else {
          $('.loader').toggle();
          GetStats(date,quizid,quizname,quizstyle);
       }
   });


    $('#refreshStats').click(function(){
      var quizstyle = $('#quizStyle option:selected').val();
      var quizid = $('#quizStats option:selected').val();
      var date = $('#reservation').val();
      var quizname = $('#quizStats option:selected').text();
        if(date == undefined || date == null || date =='') {
         $('.stattable tr').hide();
         $('.stattable tr'+id).css('display','table-row');
         //GetStats(date,id,quizname);
       } else {
          $('.loader').toggle();
          GetStats(date,quizid,quizname,quizstyle);
       }
   });

   var i = 0;
   $('#reservation').change(function(){
    if(i != 0 ){
      var date = $(this).val();
      var quizid = $('#quizStats option:selected').val();
      var quizname = $('#quizStats option:selected').text();
      var quizstyle = $('#quizStyle option:selected').val();
       $('.loader').toggle();
      GetStats(date,quizid,quizname,quizstyle);
    }
    i++;
  });

   $('form').on('focus', 'input[type=number]', function (e) {
   	$(this).on('mousewheel.disableScroll', function (e) {
   		e.preventDefault()
   	})
   })
   $('form').on('blur', 'input[type=number]', function (e) {
   	$(this).off('mousewheel.disableScroll')
   })

   /*$('#datepicker').change(function(){
      var date = $(this).val();
      var quizid = $('#quizStats option:selected').val();
      var quizname = $('#quizStats option:selected').text();
       $('.loader').toggle();
      GetStats(date,quizid,quizname);
   });*/

   $('body').on('click','.resetStats',function(){
      var id = $(this).data('id');
      var con = confirm('Are you sure you want to reset stats for this quiz?');
      if(con == true) {
        $('.loader').toggle();
        $.post({
          url: 'Update.php',
          type: 'post',
          data: 'resetStats='+id,
          success: function(data){
              window.location.reload();
          }
        });
      }
   });


   $('.globalSave').click(function(e){
    var totalSum = 0;
    var checkZero = 0;
    $('.QuizStatus').each(function(){
      if($(this).val() == 1) {
        if($(this).parent().parent().parent().find('.checkNumber').val() == 0) {
          return checkZero = 200;
        } else {
          totalSum += parseInt($(this).parent().parent().parent().find('.checkNumber').val());
           checkZero += parseInt($(this).parent().parent().parent().find('.quizstatus').val());
        }
      } else {
        checkZero += parseInt($(this).parent().parent().parent().find('.quizstatus').val());
      }
    });
     if(checkZero == 200) {
      e.preventDefault();
      alert("The rotation percentages can not be zero.");
    }
    if(checkZero == 0) {
      totalSum = 100;
    }
    if(totalSum > 100 || totalSum < 100) {
      e.preventDefault();
      alert('The quiz rotation percentages must equal 100% total for active quizzes.');
    }
    //e.preventDefault();
   		/*var totalSum = 0;
   		$('.checkNumber').each(function(){
   			totalSum += parseInt($(this).val());
        return totalSum;
   		});
      if(totalSum > 100 || totalSum < 100) {
          alert('The quiz rotation percentages must equal 100%');
          $('.checkNumber').css('border-color','red');
        } 
        if(totalSum == 100) {
          $.ajax({
            type: "POST",
            url: "Update.php",
            data: $('#globalForm').serialize(),
            success: function( response ) {
              console.log( response );
                   window.location.reload();
            }
          });
        }*/
   });	
   $('.BackPage').click(function(e){
    var getBack = sessionStorage.getItem('back');
    if(getBack == 'true') {
      history.pushState('newjibberish', null, null);
      var con = confirm('You are about to leave this page without saving?');
      if(con == true) {
         sessionStorage.removeItem('back');
          $('.BackPage').click();
      } else {
        e.preventDefault();
        $('button[type="submit"]').click();
      }
    }
   });


window.onload = function () {
    if (typeof history.pushState === "function") {
        history.pushState("jibberish", null, null);
        window.onpopstate = function () {
        	//alert('a');
            //window.history.go(-1);
            var getBack = sessionStorage.getItem('back');
            if(getBack == 'true') {
              history.pushState('newjibberish', null, null);
              var con = confirm('You are about to leave this page without saving?');
              if(con == true) {
                sessionStorage.removeItem('back');
                $('.BackPage').click();
              } else {
                $('button[type="submit"]').click();
              }
            }/* else {
              window.history.go(-1);
            }*/
            // Handle the back (or forward) buttons here
            // Will NOT handle refresh, use onbeforeunload for this.
        };
    }
    else {
        var ignoreHashChange = true;
        window.onhashchange = function () {
            if (!ignoreHashChange) {
                ignoreHashChange = true;
                window.location.hash = Math.random();
                // Detect and redirect change here
                // Works in older FF and IE9
                // * it does mess with your hash symbol (anchor?) pound sign
                // delimiter on the end of the URL
            }
            else {
                ignoreHashChange = false;   
            }
        };
    }
}
});


jQuery(document).ready(function($) {
sessionStorage.removeItem('back');

  jQuery('input').keypress(function(){
  	var a = 0;
  	jQuery('input').each(function(){
  		if(jQuery(this).val() != '') {
  			a = 1;
  		} 
  		return a;
  	});
  	if(a == 1) {
  		sessionStorage.setItem('back',true);
  	} else {
  		sessionStorage.setItem('back','');
  	}
  });
});

function GetStats(date,quizid,quizname,quizstyle) {
	var shop = $('#shop').val();
   $.post({
    url: 'Update.php',
    type: 'post',
    data: 'date='+date+'&quizid='+quizid+'&quizname='+quizname+'&shop='+shop+'&quizstyle='+quizstyle,
    success: function(data){
      console.log('data');
      //console.log(data);
       $('.loader').fadeOut(1000);
       if(data != 1) {
          $('.stattable').html(data);
          var rowCount = $('.stattable tr').length;
          $('#example2_info').text('Showing 1 to '+rowCount+' of '+rowCount+' entries');
       }
    }
  });
}

function checkedRadio(){
   $('input[type = "radio"]').change(function () {
        return false;
    });
}

