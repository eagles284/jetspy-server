<?php 

if (!isset($_SESSION['device'])) {
	$_SESSION['display'] = "Not selecting any device";
}

if (isset($_GET['device'])) {
	$_SESSION['device'] = $_GET['device'];
	$_SESSION['display'] = $_GET['display'];
}

// MySQL Credentals
$dbhost = "localhost";
$dbun = "id3440988_project";
$dbpw = "Jenix321";
$dbname = "id3440988_asspy";
$conn = mysqli_connect($dbhost, $dbun, $dbpw, $dbname);

$dataPerPage = 10;

// For directories related
$rootdir = "/";

// CSS
$style_css = "/css/style.css";
$favicon = "/res/favicon.png";

$signin_css = "/css/signin.css";
$bootstrap_min_css = "/css/bootstrap.min.css";


// MySQL Functions //

$conn = mysqli_connect($dbhost, $dbun, $dbpw, $dbname);

function dbquery($query){
	global $conn;
	$fetch = mysqli_query($conn, $query);
	$datas = [];

	while($data = mysqli_fetch_assoc($fetch)){
		$datas[] = $data;
	} return $datas;
}

function query($query){
	global $conn;
	$fetch = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($fetch);
	return $data;
}

 ?>