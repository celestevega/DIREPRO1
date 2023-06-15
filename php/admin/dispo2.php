<?php
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "mypes";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");


$sqlveterinario         = ("SELECT * FROM sector");
$dataVeterinarioSelect  = mysqli_query($con, $sqlveterinario);
while ($dataSelect = mysqli_fetch_array($dataVeterinarioSelect)) {
    echo '<option value="'.$dataSelect["id_sector"].'">'.utf8_encode($dataSelect["snombre"]).'</option>';

}
