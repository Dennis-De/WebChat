<?php 

session_start();

$pdo = new PDO('mysql:host=localhost;dbname=webchat', 'root', '');

?>

<!DOCTYPE html> 

<html> 

<head>

	<title>Status ändern</title>

	<!--<link type="text/css" rel="stylesheet" media="screen" href="design.css" />

	</style> -->

</head> 

<body>

 

<?php

$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
$userid = $_SESSION['userid'];

if(isset($_GET['optionen'])) {

 $status = trim($_POST['status']);
  

 $statement = $pdo->prepare("UPDATE users SET status = (:status) WHERE id = (:id)");
 $result = $statement->execute(array('id'=> $userid, 'status' => $status)); 

 if($result) { 

 echo 'Der Status wurde geändert in '.$status.' geändert.';

 $showFormular = false;

 } else {

 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';

 }

  

}



if($showFormular) {

?>



<form action="?optionen=1" method="post">



<fieldset>


<table>

<tr>

<td><label> Status: </label> </td>

 <td> <select name="status"><br>

<option value= "Verfügbar">Verf&uuml;gbar</option><br>

			<option value= "Beschäftigt">Besch&auml;ftigt</option><br>
			
			<option value= "Unsichtbar">Unsichtbar</option><br>
			
			<option value= "Offline">Offline</option><br>

</select></td>

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