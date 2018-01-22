<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=webchat', 'root', '');
?>
<!DOCTYPE html> 
<html> 
<head>
	<title>Registrierung</title>
	<!--<link type="text/css" rel="stylesheet" media="screen" href="design.css" />
	</style> -->
</head> 
<body>
 
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
 $error = false;
 $email = trim($_POST['email']);
 $passwort = trim($_POST['passwort']);
 $passwort2 = trim($_POST['passwort2']); 
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
 if(strlen($passwort) == 0) {
 echo 'Bitte ein Passwort angeben<br>';
 $error = true;
 }
 if($passwort != $passwort2) {
 echo 'Die Passwörter müssen übereinstimmen<br>';
 $error = true;
 }
 
 //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) { 
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $email));
 $user = $statement->fetch();
 
 if($user !== false) {
 echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
 $error = true;
 } 
 }
 
 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) { 
 $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
 
 $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, gebdat, bname, sonstiges, mobilnummer, geschlecht) VALUES (:email, :passwort, :vorname, :nachname, :gebdat, :bname, :sonstiges, :mobilnummer, :geschlecht)");
 $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'gebdat' => $gebdat, 'bname' => $bname, 'sonstiges' => $sonstiges, 'mobilnummer' => $mobilnummer, 'geschlecht' => $geschlecht));
 
 if($result) { 
 echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
 $showFormular = false;
 } else {
 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
 } 
}
 
if($showFormular) {
?>

<form action="?register=1" method="post">

<fieldset>
<legend> <h3>Kontaktformular: Bitte geben Sie Ihre Daten ein</h3></legend>
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
<td> <input type="text" name="nachname"></td>
</tr>
<tr>
<td><label> Vorname: </label></td>
<td><input type="text" name="vorname"></td>
</tr>
<tr>
<td><label for="gebdat">Geben Sie Ihr Geburtsdatum ein: </label></td>
<td><input type="text" id="gebdat" name="gebdat"/></td>
</tr>
<tr>
<td><label for="bname">Benutzername*:</label></td>
<td><input type="text" id="bname" name="bname" size="30" maxlength="30" required><br></td>
</tr>
<tr>
<td><label> Email*:</label></td>
<td><input type="email" size="40" maxlength="250" name="email"></td>
</tr>
<tr>
<td><label for="passwd">Passwort*:</label></td>
<td><input type="password" size="30"  maxlength="40" name="passwort"><br></td>
</tr>
<tr>
<td><label for="passwd">Passwort wiederholen*:</label></td>
<td><input type="password" size="30" maxlength="40" name="passwort2"><br></td>
</tr>
<tr>
<td><label>Sonstiges:</label></td>
<td><textarea name="sonstiges" placeholder="" cols= "50" rows="8"></textarea><br/><br/></td>
</tr>
<tr>
<td><label>Geben Sie ihre Mobilnummer ein:</label></td>
<td> <input type="tel" name="mobilnummer" placeholder=""></td>
</tr>
<tr>
<td><input type="submit" value="Abschicken"><br/><br/></td>
</tr>
</table>
</fieldset>
</form>
 
<?php
} //Ende von if($showFormular)
?>
 
</body>
</html>