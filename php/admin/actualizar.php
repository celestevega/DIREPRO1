<?php
include 'conectar.php';

// Verificar si se ha proporcionado un ID válido en el formulario
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['tx_nombre'];
    $cate = $_POST['tx_ape'];
    $dni = $_POST['tx_dni'];
    $telef = $_POST['tx_telef'];
    $core = $_POST['tx_correo'];
    $ruc = $_POST['tx_ruc'];
    $razon = $_POST['tx_rsocial'];
    $type = $_POST['txtcom'];
    $sect = $_POST['txtsec'];
}

// Ejecutar consulta SQL UPDATE para modificar el registro correspondiente
$sql = "UPDATE company SET nombre = '$name', apellido = '$cate', dni = '$dni', telef = '$telef', correo = '$core', ruc = '$ruc', 
tipo_empresa = $type, sector = '$sect' WHERE id_company = $id";
$result = $db_connect->query($sql);
?>
<?php if ($result) : ?>
    <script>
        alert("Datos Actualizados");
        window.location.href = "./inscripciones.php";
    </script>
<?php endif; ?>
