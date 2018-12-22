<?php

if (isset($_SESSION['device'])) {
    $device = $_SESSION['device']; 
    $threads = dbquery("SELECT DISTINCT address FROM sms WHERE user='$device'");

    if (isset($_GET['thread'])){
        $currentThread = $_GET['thread'];

        $messages = dbquery("SELECT * FROM sms WHERE user='$device' AND address='$currentThread' ORDER BY date ASC");

    }

} else { header("Location: index.php"); }

?>

<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<div class="col-s-8 well">
  <a href="/index.php">Admin Panel</a> /  <a href="/index.php?main=sms.php">SMS</a><?php if(isset($currentThread)){echo " / <b>{$currentThread}</b>";}?>
</div>

<div class="col-s-8">
  <div class="container">
  <h4>View SMS <?php if(isset($currentThread)){echo "of <b>{$currentThread}";} ?></b></h4>
  <br>
   <div class="list-group">

   <?php if(isset($_GET['thread'])): ?>
     <?php foreach ($messages as $message):?>

        <?php if($message['type'] == "received"): ?>
        <hgroup class="speech-bubbleb">
            <p style="color:white; margin-left:16px"><?=$message['body']?></p>
        </hgroup>
            <p style="color:grey;margin-bottom:16px;margin-top:-8px; font-size:75%"><?=$message['date']?></p>
        <?php elseif($message['type'] == "sent"): ?>
        <hgroup class="speech-bubble">
            <p style="color:white; margin-left:16px"><?=$message['body']?></p>
        </hgroup>
            <p style="color:grey;margin-bottom:16px;margin-top:-8px; text-align:right; font-size:75%"><?=$message['date']?></p>
        <?php endif;?>

    <?php endforeach; ?>


   <?php else: ?>

    <?php foreach ($threads as $thread):?>
      <a 
      href="?main=sms.php&thread=<?=$thread['address']?>" 
      class="list-group-item"><?php echo $thread['address'];?></a>
    <?php endforeach; ?>

    <?php endif; ?>

    </div>
</div>

</div>