<!DOCTYPE html> 
<html> 
<head>
	<title>Webchat - Profildaten bearbeiten</title>
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
 $email = trim($_POST['email']);   
 $nachname = trim($_POST['nachname']);
 $vorname = trim($_POST['vorname']);
 $gebdat = trim($_POST['gebdat']);
 $bname = trim($_POST['bname']);
 $sonstiges = trim($_POST['sonstiges']);
 $mobilnummer = trim($_POST['mobilnummer']);
 $geschlecht = trim($_POST['geschlecht']);
  
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
 $error = true;
 } 
 
 /*//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) { 
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $email));
 $user = $statement->fetch();
 
 if($user !== false) {
 echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
 $error = true;
 } 
 }*/
 
 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) { 
 //$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
  
 $statement = $pdo->prepare("UPDATE users SET email = :email, vorname = :vorname, nachname = :nachname, gebdat = :gebdat, bname = :bname, sonstiges = :sonstiges, mobilnummer = :mobilnummer, geschlecht = :geschlecht WHERE email = :useremail");
 $result = $statement->execute(array('email' => $email, 'vorname' => $vorname, 'nachname' => $nachname, 'gebdat' => $gebdat, 'bname' => $bname, 'sonstiges' => $sonstiges, 'mobilnummer' => $mobilnummer, 'geschlecht' => $geschlecht, 'useremail' => $useremail));
  
 if($result) { 
 // session vars ändern:
 $_SESSION['useremail'] = $email;
 $_SESSION['uservorname'] = $vorname;
 $_SESSION['usernachname'] = $nachname;
 $_SESSION['usergebdat'] = $gebdat;
 $_SESSION['userbname'] = $bname;
 $_SESSION['usersonstiges'] = $sonstiges;
 $_SESSION['usermobilnummer'] = $mobilnummer;
 $_SESSION['usergeschlecht'] = $geschlecht;
 
 echo 'Profildaten erfolgreich geändert. <a href="profil.php">Zur Profilseite</a>';
 $showFormular = false;
 } else {
 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
 } 
}
if($showFormular) {
?>
 
<form action="?change=1" method="post">

<fieldset>
<legend> <h3>Bitte geben Sie Ihre Änderungen ein</h3></legend>
<table>
<tr>
<td><label> Geschlecht: </label> </td>
 <td> <select name="geschlecht"><br>
<option value= "weiblich">weiblich</option><br>
<option value= "männlich">m&auml;nnlich</option><br>
</select></td>
</tr>
<tr>
<td>
<label> Nachname: </label></td>
<td> <input type="text" name="nachname" value="<?php echo $usernachname ?>"></td>
</tr>
<tr>
<td><label> Vorname: </label></td>
<td><input type="text" name="vorname" value="<?php echo $uservorname ?>"></td>
</tr>
<tr>
<td><label for="gebdat">Geben Sie Ihr Geburtsdatum ein: </label></td>
<td><input type="date" id="gebdat" name="gebdat"  value="<?php echo $usergebdat ?>"/></td>
</tr>
<tr>
<td><label for="bname">Benutzername*:</label></td>
<td><input type="text" id="bname" name="bname" size="30" maxlength="30" required value="<?php echo $userbname ?>"><br></td>
</tr>
<tr>
<td><label> Email*:</label></td>
<td><input type="email" size="40" maxlength="250" name="email" value="<?php echo $useremail ?>"></td>
</tr>
<tr>
<td><label>Sonstiges:</label></td>
<td><textarea name="sonstiges" placeholder="" cols= "50" rows="8" ><?php echo $usersonstiges ?></textarea></td>
</tr>
<tr>
<td><label>Geben Sie ihre Mobilnummer ein:</label></td>
<td> <input type="tel" name="mobilnummer" placeholder="" value="<?php echo $usermobilnummer ?>"></td>
</tr>
<tr>
<td><input id="button3" TYPE="button" value="Zurück" onClick="window.location.href = 'profil.php';"></td>
<td><input type="submit" value="Ändern"></td>
</tr>
</table>
</fieldset>
</form>	

<?php
} //Ende von if($showFormular)
?>

</body>
</html>