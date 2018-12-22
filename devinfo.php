<?php

if (isset($_SESSION['device'])) {
  $device = $_SESSION['device'];

  $mydevice['model'] = "Cannot detect model";
  $mydevice['version'] = "Cannot detect version";
  $mydevice['user'] = "Cannot detect device ID";
  $mydevice['sim'] = "Cannot detect provider";
  $macAddress = "Cannot detect MAC address";
  $ssid = "Cannot detect WiFi SSID";
  $ip = "Cannot detect device IP";
 

  $mydevice = query("SELECT * FROM device WHERE user='$device'");

  if (isset($mydevice['ssid'])){
  $network = explode("|", $mydevice['ssid']);

    if (isset($network[0])) {
      $ssid = str_replace("\"", "", $network[0]);
      if (isset($network[1])) {
        $mac = explode(":", $network[1]);
        $macAddress = "".$mac[1].":".$mac[2].":".$mac[3].":".$mac[4].":".$mac[5].":".$mac[6]."";
      }
      if (isset($network[2])) {
        $ip = str_replace("IP:", "", $network[2]);
      }
    }
  }
}

?>

<div class="col-xl-12 well">
  <a href="/panel/index.php">Admin Panel</a> / Device Info
</div>

<div class="col-xl-12">
  <div class="container">
  <h4>Live Location</h4>
   <?php if (isset($mydevice['latitude']) && isset($mydevice['latitude'])): 
          $lat = $mydevice['latitude'];
          $lon = $mydevice['longitude']?>
    <iframe
      width="99%"
      height="320"
      frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?q=<?=$lat?>,<?=$lon?>&amp;key=AIzaSyBbBqsfDlYxBASUJAY9sAMj1Rag0BPKUDY&q=Space+Needle,Seattle+WA"
      allowfullscreen>
    </iframe>
    <?php else: echo "Live Location is currently not available "; 
      endif; ?> <br>

    <h4>Device Info</h4>
    
    <?php if(isset($_SESSION['device'])): ?>
    <p>Last update: <?=$mydevice['lastupdated'];?></p>
   <div class="list-group">
      <a class="list-group-item">Model  : <b><?=$mydevice['model']?></b> </a>
      <a class="list-group-item">Manufacturer  : <b><?=$mydevice['manufacturer']?></b> </a>
      <a class="list-group-item">Version : <b><?=$mydevice['androidver']?> (API <?=$mydevice['apiver']?>)</b> </a>
      <a class="list-group-item">Kernel : <b><?=$mydevice['version']?></b> </a>
      <a class="list-group-item">IMEI  : <b><?=$mydevice['imei']?></b> </a>
      <a class="list-group-item">Device ID  : <b><?=$mydevice['user']?></b></a>
      <a class="list-group-item">Framework version  : <b><?=$mydevice['framework']?></b></a>

        
    </div>

    <h4>Network Info</h4>
   <div class="list-group">
      <a class="list-group-item">MAC  : <b><?=$macAddress?></b></a>
      <a class="list-group-item">WiFi  : <b><?=$ssid?></b></a>
      <a class="list-group-item">Public IP  : <b><?=$ip?></b></a>
      <?php if ($mydevice['sim'] === ""): ?>
          <a class="list-group-item">Provider  : <b>No provider detected</b></a>
        <?php else:  ?>
          <a class="list-group-item">Provider  : <b><?=$mydevice['sim']?></b></a>
        <?php endif; ?>
   </div>
  
    <br><br><br>
    
    <?php else: ?>
      <p>Please select a device first</p>
    <?php endif; ?>
  </div>
</div>