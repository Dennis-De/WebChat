<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=webchat', 'root', '');
?>

<!DOCTYPE html> 

<html> 

<head>

	<title>Aktueller Status</title>

	<!--<link type="text/css" rel="stylesheet" media="screen" href="design.css" />

	</style> -->

</head> 

<body>
<?php
	
if(isset($_SESSION['userid'])) {
echo ("Aktueller " ." Status: Verfügbar");
}
else
{
	echo ("Aktueller " ." Status: Offline");
}
?>
<form action="Anwesenheitsstatus_aendern.php" method="POST">
 <br><input type="submit" id="submit" name="submit" value="Status ändern"/>
</form>
</body>
</html>




