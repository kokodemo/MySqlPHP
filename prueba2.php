<?php session_start();
if (isset($_POST['radio'])) {
	$_SESSION['radio']=$_POST['radio'];	
	$radio=$_SESSION['radio'];
} ?>
<!DOCTYPE html>
<html>
<head>
	<title>prueba2</title>
</head>
<body>
<?php 
 		$conn = mysqli_connect('localhost','cjuradog','P@ssw0rd');
 		mysqli_select_db($conn, 'world');
 		$consulta = "SELECT Name , CountryCode FROM city WHERE CountryCode="."'$radio;'";
		$resultat = mysqli_query($conn, $consulta);

 		
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
?>
 	<table>
	<thead><td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td></thead>

 	<?php


 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{

					echo "\t<tr>\n";
					echo "\t\t<td>".$registre["Name"]."</td>";
					echo "\t</tr>\n";
 		}
 	

echo"<p>$radio</p>";
 ?>
</table>
</body>
</html>