<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=webchat', 'root', '');
 
if(isset($_GET['login'])) {
 $email = trim($_POST['email']);
 $passwort = trim($_POST['passwort']);
 
 $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $email));
 $user = $statement->fetch();
 
 //Überprüfung des Passworts
 if ($user !== false && password_verify($passwort, $user['passwort'])) {
 //Profildaten auslesen
 $_SESSION['userid'] = $user['id']; 
 $_SESSION['useremail'] = $user['email'];
 $_SESSION['uservorname'] = $user['vorname'];
 $_SESSION['usernachname'] = $user['nachname'];
 $_SESSION['usergebdat'] = $user['gebdat'];
 $_SESSION['userbname'] = $user['bname'];
 $_SESSION['usersonstiges'] = $user['sonstiges'];
 $_SESSION['usermobilnummer'] = $user['mobilnummer'];
 $_SESSION['usergeschlecht'] = $user['geschlecht'];
 
 die('<p>Login erfolgreich. Weiter zur <a href="profil.php">Profilseite</a></p>');
 } else {
 $errorMessage = "<p>E-Mail oder Passwort war ungültig<br></p>";
 }
 
}
?>

<!DOCTYPE html> 
<html> 
<head>
	<title>Webchat</title>
	<link type="text/css" rel="stylesheet" media="screen" href="design.css" />
	</style>
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
 echo $errorMessage;
}
?>
 
	<noscript>
		<h3>
			Um den Chat nutzen zu können aktivieren Sie bitte JavaScript!
		</h3>
	</noscript>
		
	<div id="main">
		<h2>Herzlich Willkommen im Chat-Forum!</h2>
		<p>Bitte loggen Sie sich ein bzw. registrieren sich, wenn Sie noch kein Benutzerkonto besitzen! </p> 
		
		<form action="?login=1" method="post" id="frmLogin">
		
			<div class="field-group">
				<p>E-Mail:<br></p>
				<input type="email" name="email" class="input-field"><br><br>
			</div>
			<div class="field-group">
				<p>Passwort:<br></p>
				<input type="password" name="passwort" class="input-field"><br>
			</div>
			
			<input id="button1" type="submit" value="Login">
		</form>
		
		<form>			
			<INPUT id="button2" TYPE="button" value="Registrierung" onClick="window.location.href = 'registrieren.php';">			
		</form>
	</div>

</body>
</html>