<!DOCTYPE html>
<html>
<head>
  <title>PDO</title>
</head>
<body>
<?php

  try {
    $hostname = "localhost";
    $dbname = "world";
    $username = "cjuradog";
    $pw = "P@ssw0rd";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
  
  $query = $pdo->prepare("SELECT distinct continent FROM country;");
  $query->execute();


  $e= $query->errorInfo();
  if ($e[0]!='00000') {
    echo "\nPDO::errorInfo():\n";
    die("Error accedint a dades: " . $e[2]);
  }  

  if (isset($_GET['selected'])){
    $seleccion=$_GET['selected'];
    $filtrocont="SELECT * FROM country where continent = '".$seleccion."';";
    $consfiltro = $pdo->prepare($filtrocont);
    $consfiltro->execute();
}

  $row = $query->fetch();
  echo"<form method='GET' action='pdo.php?continent=selected'>";
    echo"<select name='selected' id='sel'>";
    while ( $row ) {
      echo "<option value='".$row['continent']."'>".$row['continent']."</option>";
      $row = $query->fetch();
    }
    echo "</select>";
    echo "<input type='submit'>";
  echo "</form>";

  unset($query);
  
?>

<?php


  if (isset($_GET['selected'])){
    $seleccion=$_GET['selected'];
    $filtrocont="SELECT * FROM country where continent = '".$seleccion."';";
    $consfiltro = $pdo->prepare($filtrocont);
    $consfiltro->execute();


    $pobtotal=0;

    foreach ($consfiltro as $poblacion) {
        $pobtotal += $poblacion['Population'];
      }

    echo"<table border='2'>";
    echo"<tr><h2>Población Total ".$seleccion.":".$pobtotal."</h2></tr>";
    echo "<th id='Nom'>Nombre</th>";
    echo "<th id='Pob'>Población</th>";
    //foreach ( $consfiltro as $datos ) {
    $filtrocont="SELECT * FROM country where continent = '".$seleccion."';";
    $consfiltro = $pdo->prepare($filtrocont);
    $consfiltro->execute();
    $row = $consfiltro->fetch();
    while ($row){
       echo "<tr><td>".$row['Name']."</td>";
       echo "<td>".$row['Population']."</td></tr>\n";
       $row = $consfiltro->fetch();
      }
  
  echo "</table>";
}
  unset($consfiltro);
  unset($pdo);
?>
</body>
</html>
