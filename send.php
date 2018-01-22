<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="login.php">einloggen</a>');
}
$conn = mysqli_connect("localhost","root","","webchat");
if(!$conn){
	die("connection failled".mysqli_connect_error());
}

$msg = $_POST['msg'];
$name = $_SESSION['userbname'];

$sql = "insert into posts(msg,name) values ('$msg','$name')";
$result = $conn->query($sql);

header("Location:chat-board.php");

?>