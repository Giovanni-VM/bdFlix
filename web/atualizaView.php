<?php
  include "bd.php";
  $conn = new mysqli($host, $username, $password, $dbname);

  $idPerfil = intval($_POST["idPerfil"]);
  $idMidia = intval($_POST["idMidia"]);

  $sqlJaViu = "SELECT * FROM Historico h WHERE h.idPerfil = '$idPerfil' AND h.idMidia = '$idMidia'";
  $r = mysqli_query($conn, $sqlJaViu);
  $jaViu = mysqli_num_rows($r);

  if(!$jaViu)
    $sqlIns = "INSERT INTO Historico (idPerfil, idMidia, contador) VALUES ('$idPerfil', '$idMidia', 1)";
  else
    $sqlIns = "UPDATE Historico SET contador = contador+1 WHERE idPerfil = '$idPerfil' AND idMidia = '$idMidia'";

  mysqli_query($conn, $sqlIns);

?>
