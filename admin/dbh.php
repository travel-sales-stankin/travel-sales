<?php
$servername = "localhost";
$username = "id11860944_admin";
$password = "12345";
$dbname ="id11860944_actions";
$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("connect failed" .$conn->connect_error);

}

$conn->query("delete from actions");
$conn->query("ALTER TABLE actions AUTO_INCREMENT=0");

?>