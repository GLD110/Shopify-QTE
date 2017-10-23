<?php 
ob_start();
session_start(); 
include 'include/DBConnection.php'; ?>
<?php if(isset($_REQUEST['shop'])){ $_SESSION['shop']=$_REQUEST['shop']; } ?>
<!DOCTYPE html>
<head>
  <title>Quiz To Email</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
    <link rel="stylesheet" href="include/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="include/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="include/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="include/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="include/plugins/jvectormap/jquery-jvectormap-1.2.2.css"> 
  <link rel="stylesheet" href="include/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="include/plugins/daterangepicker/daterangepicker.css"> 
  <link rel="stylesheet" href="include/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="include/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="include/css/style.css">
  <link rel="stylesheet" href="include/plugins/iCheck/all.css">
  <link rel="stylesheet" href="include/plugins/colorpicker/bootstrap-colorpicker.min.css">
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="include/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
 <!--  <script src="include/bootstrap/js/bootstrap.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> 
 <script src="include/plugins/sparkline/jquery.sparkline.min.js"></script> 
 <script src="include/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
 <script src="include/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
 <script src="include/plugins/knob/jquery.knob.js"></script>
 <script src="include/plugins/slimScroll/jquery.slimscroll.min.js"></script>
 <script src="include/plugins/fastclick/fastclick.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
 <script src="include/plugins/daterangepicker/daterangepicker.js"></script>
 <script src="include/dist/js/app.min.js"></script>
 <script src="include/dist/js/pages/dashboard.js"></script>
 <script src="include/dist/js/demo.js"></script> 
 <script src="include/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="include/plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="include/plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="include/plugins/datatables/dataTables.bootstrap.min.js"></script>
 <script src="include/plugins/iCheck/icheck.min.js"></script>
 <script src="include/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
 <script src="include/js/custom.js"></script> 
  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="include/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="include/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="include/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="include/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="include/plugins/iCheck/icheck.min.js"></script>
  <script src="include/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
  <script src="include/js/custom.js"></script>
  <script src="include/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
  <?php if(isset($_SESSION['shop'])) { ?>
  <script type="text/javascript">
      ShopifyApp.init({
         apiKey: '<?php
         echo $app_settings->api_key; ?>',
         shopOrigin: 'https://<?php
         echo $_SESSION["shop"]; ?>'
      });
   </script>
   <script type="text/javascript">
      ShopifyApp.ready(function(){
        var url = window.location.pathname; 
        var filename = url.substring(url.lastIndexOf('/')+1); 
        var title = '';
       if(filename == 'AppMain.php') {
          title = 'Home';
       } else if(filename == 'newQuiz.php') {
          title = 'Quiz Setting';
       } else if(filename == 'AppSettings.php') {
          title = 'API Settings';
       }
       else if(filename == 'Instructions.php') {
          title = 'Instructions';
       } else {
          title = 'Stats';
       } 
         /*ShopifyApp.Bar.initialize({
            title: "Home",
         });*/
         if(title == 'Home') {
          ShopifyApp.Bar.initialize({
            buttons: {
              secondary: [
              { label: "Create Quiz", href: "newQuiz.php", target: "app" },
              { label: "View Stats", href: "Stats.php", target: "app" },
              { label: "More",
              type: "dropdown",
              links: [
              { label: "API Settings", href: "AppSettings.php", target: "app"  },
              { label: "Instructions", href: "Instructions.php", target: "app" }
              ]
            }
            ],
          },
          title: title,
          icon: 'https://www.thirstysoftware.com/quiztoemail/nimg/icon.png',
        });
         } else {
          ShopifyApp.Bar.initialize({
            buttons: {
              secondary: [
              { label: "Main Page", href: "AppMain.php", target: "app" },
              { label: "Create Quiz", href: "newQuiz.php", target: "app" },
              { label: "View Stats", href: "Stats.php", target: "app" },
              { label: "More",
              type: "dropdown",
              links: [
              { label: "API Settings", href: "AppSettings.php", target: "app"  },
              { label: "Instructions", href: "Instructions.php", target: "app" }
              ]
            }
            ],
          },
          title: title,
          icon: 'https://www.thirstysoftware.com/quiztoemail/nimg/icon.png',
        });
         }
         
         ShopifyApp.Bar.loadingOff();
      });
   </script>
   <?php } ?>
   <style>
       .box{
           background: #f4f6f8;
       }
       .tab-content img{
           border : 1px solid darkgray;
       }
   </style>
</head>
<body id="wrapper" class="marginTop">
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