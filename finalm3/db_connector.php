<?php
$server = "localhost";
$username  = 'root';
$password ='';
$database = "renthouse";
$conn = new mysqli($server, $username, $password, $database);
if($conn->connect_error){
	die($conn->connect_error);
}
