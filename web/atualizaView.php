<?php
  include "bd.php";
  $conn = new mysqli($host, $username, $password, $dbname);

  $idPerfil = intval($_POST["idPerfil"]);
  $idMidia = intval($_POST["idMidia"]);

  $sqlJaViu = "SELECT * FROM Historico h WHERE h.idPerfil = '$idPerfil' AND h.idMidia = '$idMidia'";
  $r = mysqli_query($conn, $sqlJaViu);
  $jaViu = mysqli_num_rows($r);

  if(!$jaViu){
    $sqlIns = "INSERT INTO Historico (idPerfil, idMidia, contador) VALUES ('$idPerfil', '$idMidia', 1)";
  } else {
    $sqlIns = "UPDATE Historico SET contador = contador+1 WHERE idPerfil = '$idPerfil' AND idMidia = '$idMidia'";
  }

  $sql2 = "SELECT * from Midia m WHERE m.idMidia = '$idMidia' AND m.tipo = 0";
  $r = mysqli_num_rows(mysqli_query($conn, $sql2));

  if(!$jaViu && $r){
    $sql3 = "UPDATE Filme SET contador = contador+1 WHERE idMidia = '$idMidia'";
    mysqli_query($conn, $sql3);
  }

  mysqli_query($conn, $sqlIns);

?>
