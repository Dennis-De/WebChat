<!DOCTYPE html> 
<html> 
<head>
	<title>Webchat - Benutzer suchen</title>
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

?>
<h2>Suche nach Kontakte</h2> <br>
<p>Suchen Sie nach Chat-Nutzer, um diese Ihrer Kontaktliste hinzuzufügen! </p><br>
<form action="" method="get">
    suchen nach:
    <input type="hidden" name="aktion" value="suchen">
    <input type="text" name="suchbegriff" id="suchbegriff">
    <input type="submit" value="suchen">
</form>
<?php
    if ( isset($_GET['suchbegriff']) and trim ($_GET['suchbegriff']) != '' )
    {
        $suchbegriff = trim($_GET['suchbegriff']);
        $suche_nach = "{$suchbegriff}";
		
		
        $suche = $stmt= $pdo->prepare("SELECT * FROM users WHERE email like :email");
        $suche->bindParam('s', $suche_nach);
		$suche->execute(array('email' => $suche_nach));
		
		echo "<p><b>Suchergebnis: </b></p>";
		
		while ($suche->fetch()) {
			$sql = "SELECT * FROM users WHERE email like '%{$suchbegriff}%'";
			foreach ($pdo->query($sql) as $row) {
			echo"<p><br>Zu Ihrer Suche nach: <b>$suchbegriff</b> wurde folgender Chat-Nutzer gefunden:</p>";
			echo "<br><p>Name: ".$row['vorname'].", ".$row['nachname']."</p>";
			echo "<p>Benutzername: ".$row['bname']."</p>";
			echo "<p>Email: ".$row['email']."</p><br>";
			?>
			<form action="" method=get"><input type="submit" value="Kontakt hinzufügen">
			
			 <?php
			}

        } 
    }
	else
	{

			echo "<p><b>Geben Sie bitte einen Suchbegriff ein (E-Mail)! </b></p>";
	
	}
	
	
?>
<p><input id="button3" TYPE="button" value="Zurück" onClick="window.location.href = 'profil.php';"></p>
</body>
</html>