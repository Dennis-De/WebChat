<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="login.php">einloggen</a>');
}

$conn = mysqli_connect("localhost","root","","webchat");

if(!$conn){
	die("connection failled".mysqli_connect_error());
}
?>

<!Doctype html>
<html>
	<head>
		<title>Home</title>
		<link type="text/css" rel="stylesheet" media="screen" href="chat-board.css" />
		<meta http-equiv="Refresh" content="10">
	</head>
	<div id="main">
	<h1 style="background-color: #6495ed;color: white;"> <?php echo $_SESSION['userbname']?>-<?php echo $_SESSION['userstatus'] ?></h1><br>
		<div class="output">
			<?php
				$sql = "select * FROM posts";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					while($row=$result->fetch_assoc()){
						echo "".$row["name"]." -- " .$row["date"].": " .$row["msg"]. "<br>";
						echo "<br>";
					}
				} else{
					echo "0 results";
				}
				$conn->close();
				?>
		</div>
		
	<form action="send.php" method="post">
	<textarea name="msg" placeholder="Nachricht schreiben ...." class ="form-control"></textarea> <br>
	<input type="submit" value="Abschicken">
	</form> 
	<br>
	<form action="profil.php">
	<input style="width: 100%;background-color: #6495ed;color: white;font-size: 20px;" type="submit" value="Zurück zur Profilseite">
	</form>
	</div>
	<body>
	</body>
	
</html>