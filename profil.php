<!DOCTYPE html> 
<html> 
<head>
	<title>Webchat - Profilseite</title>
	<link type="text/css" rel="stylesheet" media="screen" href="design.css" />
	</style>
</head> 
<body>

<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="login.php">einloggen</a>');
}
 
//Abfrage der Nutzer-Daten vom Login
$userid = $_SESSION['userid'];
$useremail = $_SESSION['useremail'];
$uservorname = $_SESSION['uservorname'];
$usernachname = $_SESSION['usernachname'];
$usergebdat = $_SESSION['usergebdat'];
$userbname = $_SESSION['userbname'];
$usersonstiges = $_SESSION['usersonstiges'];
$usermobilnummer = $_SESSION['usermobilnummer'];
$usergeschlecht = $_SESSION['usergeschlecht'];
 
//Darstellung der Nutzer-Daten

echo "<div id='main'>";
echo 	"<h2>Profil</h2><br>";
echo		"<table>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Benutzer-Name: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$userbname ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Nachname: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$usernachname ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Vorname: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$uservorname ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Geburtsdatum: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$usergebdat ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Geschlecht: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$usergeschlecht ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> E-Mail: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$useremail ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Mobilnummer: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$usermobilnummer ."</label>";
echo				"</td>";
echo			"</tr>";
echo			"<tr>";
echo				"<td>";
echo					"<label> Sonstiges: </label>"; 
echo				"</td>";
echo				"<td>";
echo					"<label>" .$usersonstiges ."</label>";
echo				"</td>";
echo			"</tr>";							
echo		"</table>";			
echo	"</div>";

?>

	<form>			
		<INPUT id="button1" TYPE="button" value="Logout" onClick="window.location.href = 'logout.php';">			
	</form>

</body>
</html>