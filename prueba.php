<html>
 <head>
 	<title>Exemple de lectura de dades a MySQL</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 <body>
 	<h1>Exemple de lectura de dades a MySQL</h1>
 	<?php
 		# (1.1) Connectem a MySQL (host,usuari,contrassenya)
 		$conn = mysqli_connect('localhost','cjuradog','P@ssw0rd');
 
 		# (1.2) Triem la base de dades amb la que treballarem
 		mysqli_select_db($conn, 'world');
 
 		# (2.1) creem el string de la consulta (query)
 		$consulta = "SELECT Code, Code2, Name FROM country;";
 		
 		# (2.2) enviem la query al SGBD per obtenir el resultat
 		$resultat = mysqli_query($conn, $consulta);
 		
 		# (2.3) si no hi ha resultat (0 files o bé hi ha algun error a la sintaxi)
 		#     posem un missatge d'error i acabem (die) l'execució de la pàgina web
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error() . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
 	?>
 
 	<!-- (3.1) aquí va la taula HTML que omplirem amb dades de la BBDD -->
 	<form method="POST" action="prueba2.php">
 	<table>
 	
 	<!-- la capçalera de la taula l'hem de fer nosaltres -->
 	<thead><td colspan="4" align="center" bgcolor="cyan">Llistat de ciutats</td></thead>
 	<?php
 		# (3.2) Bucle while
 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{
 			# els \t (tabulador) i els \n (salt de línia) son perquè el codi font quedi llegible
  			 
 			# (3.3) obrim fila de la taula HTML amb <tr>
 			echo "\t<tr>\n";
 
 			# (3.4) cadascuna de les columnes ha d'anar precedida d'un <td>
 			#	després concatenar el contingut del camp del registre
 			#	i tancar amb un </td>
 			
 			
 				echo "\t\t<td>".$registre["Name"]."</td>";
 				echo "<td><input type='radio' name='radio' value=".$registre['Code']."></td>";				
 				echo "<td><img src=\"https://www.countryflags.io/".strtolower($registre['Code2'])."/shiny/24.png\" /></td>";
 			# (3.5) tanquem la fila
 			echo "\t</tr>\n";
 		}

 		
 	?>
  	<!-- (3.6) tanquem la taula -->

 	</table>	
 	<input type="submit" name="select" >
 	</form>
 </body>
</html>