<?php

session_start();

$pdo = new PDO('mysql:host=localhost;dbname=webchat', 'root', '');

?>
<h2>Suche nach Kontakte</h2>
Suchen Sie nach Chat-Nutzer, um diese Ihrer Kontaktliste hinzuzufügen! <br><br>
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
		

		
		while ($suche->fetch()) {
			$sql = "SELECT * FROM users WHERE email like '%{$suchbegriff}%'";
			foreach ($pdo->query($sql) as $row) {
			echo"<p><br>Zu Ihrer Suche nach: <b>$suchbegriff</b> wurde folgender Chat-Nutzer gefunden:</p>";
			echo "Name: ".$row['vorname'].", ".$row['nachname']."<br />";
			echo "Benutzername: ".$row['bname']."<br />";
			echo "Email: ".$row['email']."<br><br>";
			?>
			<form action="" method=get"><input type="submit" value="Kontakt hinzufügen">
			
			 <?php
			}

        } 
    }
	else
	{

			echo "<p><b>Bitte geben Sie ein Suchkriterium ein. </b></p>";
	
	}
	
?>
