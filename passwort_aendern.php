<!DOCTYPE html> 
<html> 
<head>
	<title>Webchat - Passwort ändern</title>
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
$showFormular = true;
 
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

if(isset($_GET['change'])) {
 $error = false;
 $passwort_alt = trim($_POST['passwort_alt']);   
 $passwort_neu_1 = trim($_POST['passwort_neu_1']);
 $passwort_neu_2 = trim($_POST['passwort_neu_2']);
 
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $useremail));
 $user = $statement->fetch();
  
 if(!password_verify($passwort_alt, $user['passwort'])){
	 echo '<p>Passwort inkorrekt</p><br>';
 $error = true;
 }
  
 if(strlen($passwort_neu_1) == 0) {
 echo '<p>Bitte ein Passwort angeben</p><br>';
 $error = true;
 }
 if($passwort_neu_1 != $passwort_neu_2) {
 echo '<p>Die Passwörter müssen übereinstimmen</p><br>';
 $error = true;
 }
 
 //Keine Fehler, wir können das Passwort ändern
 if(!$error) { 
 $passwort_hash = password_hash($passwort_neu_1, PASSWORD_DEFAULT);
  
 $statement = $pdo->prepare("UPDATE users SET passwort = :passwort WHERE email = :useremail");
 $result = $statement->execute(array('passwort' => $passwort_hash, 'useremail' => $useremail));
  
  
 echo 'Passwort erfolgreich geändert. <a href="profil.php">Zur Profilseite</a>';
 $showFormular = false;
 } else {
 echo '<p>Beim Abspeichern ist leider ein Fehler aufgetreten</p><br>';
 } 
}
if($showFormular) {
?>
 
<form action="?change=1" method="post">

<fieldset>
<legend> <h3>Bitte geben Sie Ihre Änderungen ein</h3></legend>
<table>
<tr>
<td>
<label> Altes Passwort: </label></td>
<td> <input type="password" name="passwort_alt" value=""></td>
</tr>
<tr>
<td><label> Neues Passwort: </label></td>
<td><input type="password" name="passwort_neu_1" value=""></td>
</tr>
<tr>
<td><label> Neues Passwort wiederholen: </label></td>
<td><input type="password" name="passwort_neu_2" value=""></td>
</tr>
<tr>
<td><p><input type="submit" value="Ändern"></p></td>
</tr>
<tr>
<td><p><input id="button3" TYPE="button" value="Zurück" onClick="window.location.href = 'profil.php';"></p></td>
</tr>
</table>
</fieldset>
</form>	

<?php
} //Ende von if($showFormular)
?>

</body>
</html>