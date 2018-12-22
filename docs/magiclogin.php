<?php 
require 'config.php';

 ?>


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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/png" href="res/favicon.png"/>
</head>
<body>
<div class="page-container">
  
    <!-- top navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="container">
        <div class="navbar-header">
           <a class="navbar-brand" href="./index.php">Arya's Web Panel</a>
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
              <li class="active"><a href="./index.php">Home</a></li>
              <li><a href="./magiclogin.php">Magic Login</a></li>
              <li><a href="./logout.php">Logout</a></li>           
            </ul>
        </div>
    
        <!-- main area -->
        <div class="col-xs-12 col-sm-9">
          <div class="col-md-10 well">
           <a href="./index.php">Admin Panel</a> / Magic Login
        </div>

        <div class="col-md-10">
            <table class="table table-striped">
                <tr>
                  <th> <img src="res/mlico.png" style="width: 30px; height: 30px;"> &nbsp Mobile Legends</th>
                </tr>
                <tr> 
                  <td><p style=float:left>Moonton</p> 
                   <form action="magiclogin/ml-moonton.php">
                      <input type="submit" value="View" class="btn" style=float:right;margin-right:10px; >
                    <form action="./moonton/">
                      <input type="submit" value="Test" class="btn" style=float:right;margin-right:10px;></form>
                   </form></td></tr> 
                   <tr> 
                  <td><p style=float:left>Facebook</p> 
                   <form action="magiclogin/ml-moonton.php">
                      <input type="submit" value="View" class="btn" style=float:right;margin-right:10px; >
                    <form action="./moonton/">
                      <input type="submit" value="Test" class="btn" style=float:right;margin-right:10px;></form>
                   </form></td></tr> 
                   <tr> 
                  <td><p style=float:left>Google</p> 
                   <form action="magiclogin/ml-moonton.php">
                      <input type="submit" value="View" class="btn" style=float:right;margin-right:10px; >
                    <form action="./moonton/">
                      <input type="submit" value="Test" class="btn" style=float:right;margin-right:10px;></form>
                   </form></td></tr> 
                   <tr> 
                  <td><p style=float:left>VK</p> 
                   <form action="magiclogin/ml-moonton.php">
                      <input type="submit" value="View" class="btn" style=float:right;margin-right:10px; >
                    <form action="./moonton/">
                      <input type="submit" value="Test" class="btn" style=float:right;margin-right:10px;></form>
                   </form></td></tr> 
             
            </table>
        </div>
          
          
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


