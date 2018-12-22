<?php

if (isset($_SESSION['device'])) {
  $device = $_SESSION['device'];

  //$dataPerPage = 10;
  $totalData = count(dbquery("SELECT * FROM calllog WHERE
  user='$device'"));

  $pages = ceil($totalData / $dataPerPage);
  if(isset($_GET['pg'])){
    $page = $_GET['pg'];
  } else {$page = 1;}
  $firstData = ($dataPerPage * $page) - $dataPerPage;

  $logs = dbquery("SELECT * FROM calllog WHERE user='$device' ORDER BY callDate DESC
  LIMIT $firstData, $dataPerPage");
}
?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Calls
</div>

<div class="col-xl-12">
  <div class="container">
    <h4>Call Log </h4>
    
    <?php if(isset($_SESSION['device'])): ?>

 <table class="table table-striped">
    <thead>
      <tr>
        <th>Call Date</th>
        <th>Type</th>
        <th>Number</th>
        <th>Duration</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($logs as $log): 
        ?>
      <tr>
        <td><?=$log['callDate']?></td>
        <td><?=$log['callType']?></td>
        <td><?=$log['callNumber']?></td>
        <td><?=$log['callDurationSeconds']?></td>
      </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    
    <ul class="pagination">
              <?php 
            if($page <= 1){
              echo '<li><a href="">Prev</a></li>';
            } else {
              $thispage = $page - 1;
              echo "<li><a href='?main=calllog.php&pg=$thispage'>Prev</a></li>";
            }
            for ($i=1; $i <= $pages ; $i++) { 
              if($i<>$page){
                echo "<li><a href='?main=calllog.php&pg=$i'>$i</a></li>";
              } else {
              echo "<li class='active'><a href=''>$i</a></li>";
            } 
          }
          if($page==$pages){
              echo "<li><a href=''>Next</a></li>";
            } else {
              $thispage = $page + 1;
              echo "<li><a href='?main=calllog.php&pg=$thispage'>Next</a></li>";
            }
             ?>
              <!-- <li><a href="#">1</a></li> -->
            </ul>


    <br>


    
    <?php else: ?>
    <p>Please select a device first</p>
    <?php endif; ?>

  </div>
</div>