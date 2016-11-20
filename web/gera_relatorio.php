<?php

include "classes/class_fatura.php";
include "bd.php";

$conn = new mysqli($host, $username, $password, $dbname);

if($_POST["tipo"] == 1){
	$sql = "SELECT * FROM fatura WHERE dataIni >= '".$_POST["dtInicio"]."' AND dataIni <= '".$_POST["dtFim"]."' AND paga = 1";
	$faturas = Fatura::__querySQL($sql, $conn);
	$arrays = [];
	foreach($faturas as $fat){
		$arrays[] = $fat->convertArray();
	}
}

?>


<?php session_start(); 
include "classes/class_perfil.php";
include "bd.php";
include "classes/class_genero.php";


$sql = "SELECT * FROM perfil WHERE nome = '". $_SESSION["user"]."'";
$conn = new mysqli($host, $username, $password, $dbname);

$conn->close();
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>BdFlix</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/table.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Cinema Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>


</head>
<body>
	<!-- header-section-starts -->
	<div class="full">

		<div class="main">
			
		<div class="header">
			<div class="top-header">
				<div class="logo">
					<p><?php echo "Usuario: ".$_SESSION["user"]; ?> </p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="main-contact">
				
		 
			</div>
			
			<div>
				<center>
					<input type = "button" name = "voltar" value = "voltar" onclick = "javascript:window.history.go(-1);">
					<input type = "button" name = "imprimir" value = "Imprimir" onclick = "window.print();">
					<table cellpadding = "0"  cellspacing = "0" class = "display" id="tabelaCliente">
                        <thead>
                            <tr>
								<?php
									foreach ($arrays[0] as $key=>$coluna){
										echo "<th>" . $key . "</th>";
									}
								?>                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php
								foreach($arrays as $item){
									echo "<tr>";
									foreach($item as $coluna){
										echo "<td>" . $coluna . "</td>";
									}
									echo "</tr>";
								}       
                            ?>   
                        </tbody>
                    </table>
				</center>
			</div>
		</div>
		
		
	</div>
	</div>
	<div class="clearfix"></div>
</body>
</html>
