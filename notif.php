<?php

// =================

if (isset($_SESSION['device'])) {
  $device = $_SESSION['device'];

  $selector = "";

    if(isset($_GET['sender'])){
        $sender = $_GET['sender'];
    }

  if(isset($_GET['notif'])) {
      $selector = $_GET['notif'];
  }

  //$dataPerPage = 10;
  $totalData = count(dbquery("SELECT * FROM notification WHERE
  user='$device' AND 
  notiftype='all' AND 
  sender LIKE '%{$selector}%' AND
  sender NOT LIKE '%board%' AND
  content NOT LIKE '%board%'
  ORDER BY receivedTime DESC"));

  $pages = ceil($totalData / $dataPerPage);
  if(isset($_GET['pg'])){
    $page = $_GET['pg'];
  } else {$page = 1;}
  $firstData = ($dataPerPage * $page) - $dataPerPage;

  $showsender = false;
  $notives = dbquery("SELECT * FROM notification WHERE
   user='$device' AND 
    notiftype='all' AND 
    sender LIKE '%{$selector}%' AND
    sender NOT LIKE '%board%' AND
    content NOT LIKE '%board%'
    ORDER BY receivedTime DESC
    LIMIT $firstData, $dataPerPage");
} else { header("Location: index.php"); }

?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Notification
</div>

<div class="col-xl-12">
  <div class="container">
    <h4>Received Notifications </h4>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="?main=notif.php">All</a></li>
    <li><a href="?main=notif.php&notif=instagram">Instagram</a></li>
    <li><a href="?main=notif.php&notif=whatsapp">Whatsapp</a></li>
    <li><a href="?main=notif.php&notif=line">LINE</a></li>
  </ul>
</div>
    </div>
    <div class="col-sm-2">
    <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Toggle Sender
  <span class="caret"></span></button>
  <ul class="dropdown-menu">

    <?php if (isset($_GET['notif']) && !isset($_GET['pg'])): ?>
    <li><a href="?main=notif.php&notif=<?=$_GET['notif']?>&sender=1">Enable</a></li>
    <li><a href="?main=notif.php&notif=<?=$_GET['notif']?>">Disable</a></li>
    <?php elseif (!isset($_GET['notif']) && !isset($_GET['pg'])): ?>
    <li><a href="?main=notif.php&sender=1">Enable</a></li>
    <li><a href="?main=notif.php">Disable</a></li>
    <?php elseif (isset($_GET['pg']) && isset($_GET['notif'])): ?>
    <li><a href="?main=notif.php&pg=<?=$page?>notif=<?=$_GET['notif']?>&sender=1">Enable</a></li>
    <li><a href="?main=notif.php&pg=<?=$page?>&notif=<?=$_GET['notif']?>">Disable</a></li>
    <?php elseif (isset($_GET['pg'])): ?>
    <li><a href="?main=notif.php&pg=<?=$page?>&sender=1">Enable</a></li>
    <li><a href="?main=notif.php&pg=<?=$page?>">Disable</a></li>
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
        <th>Received Time</th>
        <th>Content</th>
        <?php if(isset($_GET['sender'])): ?>
            <th>Sender</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
    <?php foreach($notives as $notif): 
    $daterep = str_replace("GMT+07:00", "", $notif['receivedTime']);
    $dates = explode(":", $daterep);
        ?>
      <tr>
        <td><?="{$dates[0]}:{$dates[1]}"?></td>
        <td><?=$notif['content']?></td>
        <?php if($sender): ?>
        <td><?=$notif['sender']?></td>
        <?php endif; ?>
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    
    <?php if(isset($_GET['sender'])): ?>
        <ul class="pagination">
                  <?php 
                if($page <= 1){
                  echo '<li><a href="">Prev</a></li>';
                } else {
                  $thispage = $page - 1;
                  echo "<li><a href='?main=notif.php&pg=$thispage&sender=1'>Prev</a></li>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                  if($i<>$page){
                    echo "<li><a href='?main=notif.php&pg=$i&sender=1'>$i</a></li>";
                  } else {
                  echo "<li class='active'><a href=''>$i</a></li>";
                } 
              }
              if($page==$pages){
                  echo "<li><a href=''>Next</a></li>";
                } else {
                  $thispage = $page + 1;
                  echo "<li><a href='?main=notif.php&pg=$thispage&sender=1'>Next</a></li>";
                }
                 ?>
                  <!-- <li><a href="#">1</a></li> -->
                </ul>
                
    <?php else: ?>
    
     <ul class="pagination">
                  <?php 
                if($page <= 1){
                  echo '<li><a href="">Prev</a></li>';
                } else {
                  $thispage = $page - 1;
                  echo "<li><a href='?main=notif.php&pg=$thispage'>Prev</a></li>";
                }
                for ($i=1; $i <= $pages ; $i++) { 
                  if($i<>$page){
                    echo "<li><a href='?main=notif.php&pg=$i'>$i</a></li>";
                  } else {
                  echo "<li class='active'><a href=''>$i</a></li>";
                } 
              }
              if($page==$pages){
                  echo "<li><a href=''>Next</a></li>";
                } else {
                  $thispage = $page + 1;
                  echo "<li><a href='?main=notif.php&pg=$thispage'>Next</a></li>";
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