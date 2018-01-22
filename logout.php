<!DOCTYPE html> 
<html> 
<head>
	<title>Logout</title>
	<link type="text/css" rel="stylesheet" media="screen" href="design.css" />
	</style>
</head> 
<body>

<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="login.php">einloggen</a>');
}
$pdo = new PDO('mysql:host=localhost;dbname=webchat', 'root', '');
$_SESSION['userstatus'] = 'Offline';
 
$statement = $pdo->prepare("UPDATE users SET status = (:status) WHERE id = (:id)");
$result = $statement->execute(array('id'=> $_SESSION['userid'], 'status' => $_SESSION['userstatus'])); 
 
session_destroy();
 
echo "<p>Logout erfolgreich</p>";
	
?>

<form>			
		<INPUT id="button1" TYPE="button" value="Zurück zum Login" onClick="window.location.href = 'login.php';">			
</form>

</body>
</html>