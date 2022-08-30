<?php
	//$servername = "192.168.254.100";
$servername = "91.192.194.139";
$username = "idessrte_sample";
$password = 'Jc-rt%^hK&B$_sample';
$database = "idessrte_sample";
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "auxiliary";

$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn) {

	die ("Connection failed:".mysqli_error($conn));
}
  ?>
