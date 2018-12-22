<?php

if (isset($_SESSION['device'])) {
  $device = $_SESSION['device'];

  //$dataPerPage = 10;
  $totalData = count(dbquery("SELECT * FROM location WHERE
  user='$device'"));

  $pages = ceil($totalData / $dataPerPage);
  if(isset($_GET['pg'])){
    $page = $_GET['pg'];
  } else {$page = 1;}
  $firstData = ($dataPerPage * $page) - $dataPerPage;

  $histories = dbquery("SELECT * FROM location 
  WHERE user='$device' 
  ORDER BY date DESC
  LIMIT $firstData, $dataPerPage");
}

?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Location History
</div>

<div class="col-xl-12">
  <div class="container">
    <h4>Location History </h4>
    
    <?php if(isset($_SESSION['device'])): ?>

    <?php if (isset($_GET['lat']) && isset($_GET['lon'])): 
                        $lat = $_GET['lat'];
                        $lon = $_GET['lon']?>
    <iframe
      width="99%"
      height="320"
      frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?q=<?=$lat?>,<?=$lon?>&amp;key=AIzaSyBbBqsfDlYxBASUJAY9sAMj1Rag0BPKUDY&q=Space+Needle,Seattle+WA"
      allowfullscreen>
    </iframe>

    <?php else: echo "Click locations below to display location "; 
      endif; ?>
  
    <br><br>

    <?php foreach($histories as $history): 
        $daterep = str_replace("GMT+07:00", "", $history['date']);
        $dates = explode(":", $daterep);
        
        ?>
        <a 
        href="?main=lochistory.php&lat=<?=$history['lat']?>&lon=<?=$history['lon']?>" 
        class="list-group-item"><?php echo "{$dates[0]}:{$dates[1]}";?></a>
    <?php endforeach;?>
    
    <ul class="pagination">
              <?php 
            if($page <= 1){
              echo '<li><a href="">Prev</a></li>';
            } else {
              $thispage = $page - 1;
              echo "<li><a href='?main=lochistory.php&pg=$thispage'>Prev</a></li>";
            }
            for ($i=1; $i <= $pages ; $i++) { 
              if($i<>$page){
                echo "<li><a href='?main=lochistory.php&pg=$i'>$i</a></li>";
              } else {
              echo "<li class='active'><a href=''>$i</a></li>";
            } 
          }
          if($page==$pages){
              echo "<li><a href=''>Next</a></li>";
            } else {
              $thispage = $page + 1;
              echo "<li><a href='?main=lochistory.php&pg=$thispage'>Next</a></li>";
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