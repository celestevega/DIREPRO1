<?php
$conexion=mysqli_connect('localhost','root','','mypes');
$continente = $_POST['provincia'];

// Verificar si la conexión se estableció correctamente
    $sql = "SELECT id, 
	                id_provincia,
	                provincias
            FROM provincias
            WHERE id_provincia='$continente'";

    $result = mysqli_query($conexion, $sql);

    $cadena = "<label> Distritos</label>
	<select id='lista2' name='lista2'>";

    while ($ver = mysqli_fetch_row($result)) {
        $cadena = $cadena . '<option value=' . $ver[0] . '>' . utf8_encode($ver[2]) . '</option>';
    }

    echo $cadena . "</select>";
?>
