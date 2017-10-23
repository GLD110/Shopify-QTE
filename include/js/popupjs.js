jQuery('body').on('click','.YesButton',function(e){
      e.preventDefault();
      //jQuery('.modal-body form').attr('target','_blank');
   /*   if(jQuery(this).text() == 'Submit') {
        if(jQuery('#name').val() == '') {
          jQuery('#email-error').text('Please enter name.');
        }
        else if(jQuery('#email').val().search('@') > 0 &&  jQuery('#email').val().search('.') >= 0) {
          jQuery('input[type="text"],input[name="name"]').val(jQuery('#name').val());
          jQuery('input[type="email"],input[name="email"]').val(jQuery('#email').val());
          jQuery('#mc-embedded-subscribe').click();
          jQuery('input[type="image"]').click();
          submitEmail(jQuery('#qid').val(),jQuery('#quizstyle').val());
          jQuery(this).parent().parent().parent().parent().hide();
          jQuery(this).parent().parent().parent().parent().next().show();
        } else {
          jQuery('#email-error').text('Please enter a valid email address.');
        }
      } else {
        
      }*/
      var ans = jQuery(this).data('answer');
      if(ans == '' || ans == null || ans == undefined) {
        ans = jQuery(this).text();
      }
      jQuery('input[value="'+ans+'"]').prop("checked",true);
      jQuery(this).parent().parent().parent().parent().hide();
      jQuery(this).parent().parent().parent().parent().next().show();
    });
    
    jQuery('input[type="email"],input[type="text"]').parent().show();

setTimeout(function(){
     jQuery('.af-element input[type="text"],.af-element input[name="name"]').parent().parent().show();
     jQuery('.af-element input[type="text"],.af-element input[name="email"]').parent().parent().show();
     jQuery('.af-element.buttonContainer input').removeAttr('src');
     jQuery('.af-element.buttonContainer input').removeAttr('style');
     jQuery('.af-element.buttonContainer input').attr('type','submit');
     jQuery('.af-element.buttonContainer input').attr('value','Submit');
},1500);

    /*jQuery('body').on('keyup','.emailInput',function(){
        jQuery('input[type="email"],input[name="email"]').val(jQuery(this).val());
    });

    jQuery('body').on('keyup','.nameInput',function(){
      jQuery('input[type="text"],input[name="name"]').val(jQuery(this).val());
    });

    jQuery('body').on('click','.optFormSubmit',function(){
        alert('a');
        jQuery('#mc-embedded-subscribe-form').submit();
    });*/


    jQuery('body').on('click','input[type="submit"],input[type="image"]',function(e){
      //e.preventDefault();
        //localStorage.setItem('statAjax',jQuery('#qid').val()+'[::]'+jQuery('#quizstyle').val()+'[::]'+jQuery('input[type="email"],input[name="email"]').val());
        //alert(jQuery('input[type="email"],input[name="email"]').val());
         //submitEmail(jQuery('#qid').val(),jQuery('#quizstyle').val(),jQuery('input[type="email"],input[name="email"]').val());
      if(jQuery('input[type="email"],input[name="email"]').val() != '') {
          hostname = window.location.hostname;
          jQuery.ajax({
            url: 'https://www.thirstysoftware.com/finalApp/app/Update.php',
            type: 'GET',
            data: 'id='+jQuery('#qid').val()+'&quizstyle='+jQuery('#quizstyle').val()+'&hostname='+hostname+'&email='+jQuery('input[type="email"],input[name="email"]').val(),
            success: function(data){
             // console.log('data sa');
              //console.log(data);
            }
          });
          if(jQuery('#pbar').val() == 0) {
           jQuery('.embeded-opt-code').parent().parent().parent().hide();
           jQuery('.embeded-opt-code').parent().parent().parent().next().show();
           } else {
            jQuery('.embeded-opt-code').parent().parent().parent().parent().parent().parent().hide();
            jQuery('.embeded-opt-code').parent().parent().parent().parent().parent().parent().next().show();
            jQuery('.nav.nav-pills.nav-justified.thumbnail.setup-panel li').each(function(){
              if(jQuery(this).attr('class') == 'active') {
                jQuery(this).next().addClass('active');
                jQuery(this).next().removeClass('disabled');
                jQuery(this).removeClass('active');
                jQuery(this).addClass('disabled');
                return false;
              }
            });
          }
      } else {
        e.preventDefault();
        alert('Please Enter a valid E-mail Address.');
      }
    });

    jQuery('body').on('click','.selected-li',function(){
      var ans = jQuery(this).children().children().text();
      jQuery('input[value="'+ans+'"]').prop("checked",true);
      jQuery('select option:contains('+ans+')').prop('selected',true);
      jQuery(this).parent().parent().parent().parent().parent().parent().hide();
      jQuery(this).parents().next().show();
    });
    jQuery(".dropdown img.flag").addClass("flagvisibility");

    jQuery(".dropdown dt a").click(function() {
      jQuery(".dropdown dd ul").toggle();
    });

    jQuery("body").on('click','.dropdown dd ul li a',function() {
      var text = jQuery(this).html();
      //jQuery(".dropdown dt a span").html(text);
      jQuery(".dropdown dd ul").hide();
      jQuery("#result").html("Selected value is: " + getSelectedValue("sample"));
    });

    function getSelectedValue(id) {
      return jQuery("#" + id).find("dt a span.value").html();
    }

    jQuery(document).bind('click', function(e) {
      var jQueryclicked = jQuery(e.target);
      if (! jQueryclicked.parents().hasClass("dropdown"))
        jQuery(".dropdown dd ul").hide();
    });
    jQuery(".dropdown img.flag").toggleClass("flagvisibility");
  

    jQuery('body').on('click','.activateButton',function(e){
      e.preventDefault();
      var ans = jQuery(this).data('answer');
      if(ans == '' || ans == null || ans == undefined) {
        ans = jQuery(this).text();
      }
      jQuery('input[value="'+ans+'"]').prop("checked",true);
      var id = jQuery(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
      jQuery('.nav.nav-pills').find('#'+id).removeClass('active');
      jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
      jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
      jQuery('.nav.nav-pills').find('#'+id).next().removeClass('disabled');
      jQuery('.nav.nav-pills').find('#'+id).next().addClass('active');
      jQuery(this).parent().parent().parent().parent().parent().parent().parent().hide();
      jQuery(this).parent().parent().parent().parent().parent().parent().parent().next().show();
    });    

   /* jQuery('body').on('click','.activateButton',function(e){
      e.preventDefault();
       jQuery('#mc-embedded-subscribe').click();
      //jQuery('.modal-body form').attr('target','_blank');
      if(jQuery(this).text() == 'Submit') {
         if(jQuery('#name').val() == '') {
          jQuery('#email-error').text('Please enter name.');
        }
       else if(jQuery('#email').val().search('@') > 0 &&  jQuery('#email').val().search('.') >= 0) {
          alert(jQuery('#email').val());
          jQuery('input[type="text"],input[name="name"]').val(jQuery('#name').val());
          jQuery('input[type="email"],input[name="email"]').val(jQuery('#email').val());
        
        //  jQuery('input[type="image"]').click();
          //submitEmail(jQuery('#qid').val(),jQuery('#quizstyle').val());
          var id = jQuery(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
          jQuery('.nav.nav-pills').find('#'+id).removeClass('active');
          jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
          jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
          jQuery('.nav.nav-pills').find('#'+id).next().removeClass('disabled');
          jQuery('.nav.nav-pills').find('#'+id).next().addClass('active');
          jQuery(this).parent().parent().parent().parent().parent().parent().parent().hide();
          jQuery(this).parent().parent().parent().parent().parent().parent().parent().next().show();
        } else {
          jQuery('#email-error').text('Please enter a valid email address.');
        }
      } else {
         var ans = jQuery(this).data('answer');
        if(ans == '' || ans == null || ans == undefined) {
          ans = jQuery(this).text();
        }
       jQuery('input[value="'+ans+'"]').prop("checked",true);
        var id = jQuery(this).parent().parent().parent().parent().parent().parent().parent().attr('id');
        jQuery('.nav.nav-pills').find('#'+id).removeClass('active');
        jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
        jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
        jQuery('.nav.nav-pills').find('#'+id).next().removeClass('disabled');
        jQuery('.nav.nav-pills').find('#'+id).next().addClass('active');
        jQuery(this).parent().parent().parent().parent().parent().parent().parent().hide();
        jQuery(this).parent().parent().parent().parent().parent().parent().parent().next().show();
      }
      
    });*/
    jQuery('body').on('click','.active-selected-li',function(){
       var ans = jQuery(this).children().children().text();
      jQuery('.input[value="'+ans+'"]').prop("checked",true);
      jQuery('select option:contains('+ans+')').prop('selected',true);
      var id = jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().attr('id');
      jQuery('.nav.nav-pills').find('#'+id).removeClass('active');
      jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
      jQuery('.nav.nav-pills').find('#'+id).addClass('disabled');
      jQuery('.nav.nav-pills').find('#'+id).next().removeClass('disabled');
      jQuery('.nav.nav-pills').find('#'+id).next().addClass('active');
      jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().hide();
      jQuery(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().next().show();
    });


    jQuery('body').on('click','#meraButton',function(){
     var qid = jQuery('#qid').val();
     aler
     var quizstyle = jQuery('#quizstyle').val();
     var email = jQuery('#email').val();
     var hostname = 'adrianapp.myshopify.com';
     jQuery.post({
      url: 'https://www.thirstysoftware.com/QuizToEmail/Update.php',
      type: 'post',
      data: 'id='+id,
      success: function(data){
        console.log('data');
        console.log(data);
      }
    });
   });

    function submitEmail(id,quizstyle,email) {
      //alert('email = '+email+' id '+id+ ' quizstyle '+quizstyle);
      var hostname = window.location.hostname;
         jQuery.ajax({
          url: 'https://www.thirstysoftware.com/QuizToEmail/Update.php',
          type: 'GET',
          data: 'id='+id+'&quizstyle='+quizstyle+'&hostname='+hostname+'&email='+email,
          success: function(data){
            console.log('data');
            console.log(data);
          }
        });
    }



