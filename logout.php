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
session_destroy();
 
echo "<p>Logout erfolgreich</p>";
	
?>

<form>			
		<INPUT id="button1" TYPE="button" value="Zurück zum Login" onClick="window.location.href = 'login.php';">			
</form>

</body>
</html>