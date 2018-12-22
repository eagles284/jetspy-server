<?php

$device = dbquery("SELECT * FROM device");

?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Select Device
</div>

<div class="col-xl-12">
  <div class="container">
  <h4>Select Current Device</h4>
   <div class="list-group">

    <?php foreach ($device as $dev):?>
      <a 
      href="?device=<?=$dev['user']?>&display=<?=$dev['model']?>" 
      class="list-group-item"><?php echo $dev['model']; echo " | "; echo $dev['user']; ?></a>
    <?php endforeach; ?>

    </div>
</div>

</div>