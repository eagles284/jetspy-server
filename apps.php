<?php

// =================

if (isset($_SESSION['device'])) {
  $device = $_SESSION['device'];

  $selector = "";

    if(isset($_GET['pckname'])){
        $pckname = $_GET['pckname'];
    }

  if(isset($_GET['app'])) {
      $selector = $_GET['app'];
  }

  //$dataPerPage = 10;
  $totalData = count(dbquery("SELECT * FROM apps WHERE
  user='$device' AND 
  sourcedir LIKE '%{$selector}%' 
  ORDER BY appname DESC"));

  $pages = ceil($totalData / $dataPerPage);
  if(isset($_GET['pg'])){
    $page = $_GET['pg'];
  } else {$page = 1;}
  $firstData = ($dataPerPage * $page) - $dataPerPage;

  $showpckname = false;
  $apps = dbquery("SELECT * FROM apps WHERE
   user='$device' AND 
    sourcedir LIKE '%{$selector}%' 
    ORDER BY appname DESC
    LIMIT $firstData, $dataPerPage");
} else { header("Location: index.php"); }

?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Apps
</div>

<div class="col-xl-12">
  <div class="container">
    <h4>Application List</h4>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="?main=apps.php">All Apps</a></li>
    <li><a href="?main=apps.php&app=data">Installed Apps</a></li>
    <li><a href="?main=apps.php&app=system">System Apps</a></li>
  </ul>
</div>
    </div>
    <div class="col-sm-2">
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Toggle Package Name
  <span class="caret"></span></button>
  <ul class="dropdown-menu">

    <?php if (isset($_GET['app']) && !isset($_GET['pg'])): ?>
    <li><a href="?main=apps.php&app=<?=$_GET['app']?>&pckname=1">Enable</a></li>
    <li><a href="?main=apps.php&app=<?=$_GET['app']?>">Disable</a></li>
    <?php elseif (!isset($_GET['app']) && !isset($_GET['pg'])): ?>
    <li><a href="?main=apps.php&pckname=1">Enable</a></li>
    <li><a href="?main=apps.php">Disable</a></li>
    <?php elseif (isset($_GET['pg']) && isset($_GET['app'])): ?>
    <li><a href="?main=apps.php&pg=<?=$page?>app=<?=$_GET['app']?>&pckname=1">Enable</a></li>
    <li><a href="?main=apps.php&pg=<?=$page?>&app=<?=$_GET['app']?>">Disable</a></li>
    <?php elseif (isset($_GET['pg'])): ?>
    <li><a href="?main=apps.php&pg=<?=$page?>&pckname=1">Enable</a></li>
    <li><a href="?main=apps.php&pg=<?=$page?>">Disable</a></li>
    <?php endif; ?>
        

  </ul>
</div>
    </div>
  </div>
</div>

</div>
    
    <?php if(isset($_SESSION['device'])): ?>

 <table class="table table-striped">
    <thead>
      <tr>
        <th>App Name</th>
        <?php if(isset($_GET['pckname'])): ?>
            <th>Package Name</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
    <?php foreach($apps as $appe): ?>
      <tr>
        <td><?=$appe['appname']?></td>
        <?php if($pckname): ?>
        <td><?=$appe['pckname']?></td>
        <?php endif; ?>
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    
    <?php if(isset($_GET['pckname']) && !isset($_GET['app'])): ?>
        <ul class="pagination">
                  <?php 
                if($page <= 1){
                  echo '<li><a href="">Prev</a></li>';
                } else {
                  $thispage = $page - 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage&pckname=1'>Prev</a></li>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                  if($i<>$page){
                    echo "<li><a href='?main=apps.php&pg=$i&pckname=1'>$i</a></li>";
                  } else {
                  echo "<li class='active'><a href=''>$i</a></li>";
                } 
              }
              if($page==$pages){
                  echo "<li><a href=''>Next</a></li>";
                } else {
                  $thispage = $page + 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage&pckname=1'>Next</a></li>";
                }
                 ?>
                  <!-- <li><a href="#">1</a></li> -->
                </ul>
                
    <?php elseif(!isset($_GET['pckname']) && !isset($_GET['app'])): ?>
    
     <ul class="pagination">
                  <?php 
                if($page <= 1){
                  echo '<li><a href="">Prev</a></li>';
                } else {
                  $thispage = $page - 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage'>Prev</a></li>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                  if($i<>$page){
                    echo "<li><a href='?main=apps.php&pg=$i'>$i</a></li>";
                  } else {
                  echo "<li class='active'><a href=''>$i</a></li>";
                } 
              }
              if($page==$pages){
                  echo "<li><a href=''>Next</a></li>";
                } else {
                  $thispage = $page + 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage'>Next</a></li>";
                }
                 ?>
                  <!-- <li><a href="#">1</a></li> -->
                </ul>
                
                 
    <?php elseif(isset($_GET['pckname']) && isset($_GET['app'])): ?>
        <ul class="pagination">
                  <?php 
                if($page <= 1){
                  echo '<li><a href="">Prev</a></li>';
                } else {
                  $thispage = $page - 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage&pckname=1&app=$selector'>Prev</a></li>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                  if($i<>$page){
                    echo "<li><a href='?main=apps.php&pg=$i&pckname=1&app=$selector'>$i</a></li>";
                  } else {
                  echo "<li class='active'><a href=''>$i</a></li>";
                } 
              }
              if($page==$pages){
                  echo "<li><a href=''>Next</a></li>";
                } else {
                  $thispage = $page + 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage&pckname=1&app=$selector'>Next</a></li>";
                }
                 ?>
                  <!-- <li><a href="#">1</a></li> -->
                </ul>
                
    <?php elseif(!isset($_GET['pckname']) && isset($_GET['app'])): ?>
    
     <ul class="pagination">
                  <?php 
                if($page <= 1){
                  echo '<li><a href="">Prev</a></li>';
                } else {
                  $thispage = $page - 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage&app=$selector'>Prev</a></li>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                  if($i<>$page){
                    echo "<li><a href='?main=apps.php&pg=$i&app=$selector'>$i</a></li>";
                  } else {
                  echo "<li class='active'><a href=''>$i</a></li>";
                } 
              }
              if($page==$pages){
                  echo "<li><a href=''>Next</a></li>";
                } else {
                  $thispage = $page + 1;
                  echo "<li><a href='?main=apps.php&pg=$thispage&app=$selector'>Next</a></li>";
                }
                 ?>
                  <!-- <li><a href="#">1</a></li> -->
                </ul>
                
        <?php endif; ?>
    
    
    <br>
    
    <?php else: ?>
    <p>Please select a device first</p>
    <?php endif; ?>

  </div>
</div>