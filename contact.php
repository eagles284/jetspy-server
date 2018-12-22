<?php

if (isset($_SESSION['device'])) {
  $device = $_SESSION['device'];

  //$dataPerPage = 10;
  $totalData = count(dbquery("SELECT * FROM contacts WHERE
  user='$device'"));

  $pages = ceil($totalData / $dataPerPage);
  if(isset($_GET['pg'])){
    $page = $_GET['pg'];
  } else {$page = 1;}
  $firstData = ($dataPerPage * $page) - $dataPerPage;

  $contacts = dbquery("SELECT * FROM contacts WHERE user='$device' ORDER BY name ASC
  LIMIT $firstData, $dataPerPage");
}

?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Contacts
</div>

<div class="col-xl-12">
  <div class="container">
    <h4>Contact List </h4>
    
    <?php if(isset($_SESSION['device'])): ?>

 <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Number </th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($contacts as $contact): 
        ?>
      <tr>
        <td><?=$contact['name']?></td>
        <td><?=$contact['phoneNumber']?></td>
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
              echo "<li><a href='?main=contact.php&pg=$thispage'>Prev</a></li>";
            }
            for ($i=1; $i <= $pages ; $i++) { 
              if($i<>$page){
                echo "<li><a href='?main=contact.php&pg=$i'>$i</a></li>";
              } else {
              echo "<li class='active'><a href=''>$i</a></li>";
            } 
          }
          if($page==$pages){
              echo "<li><a href=''>Next</a></li>";
            } else {
              $thispage = $page + 1;
              echo "<li><a href='?main=contact.php&pg=$thispage'>Next</a></li>";
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