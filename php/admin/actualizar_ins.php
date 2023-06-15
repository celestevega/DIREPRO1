<?php
include 'conectar.php';

// Verificar si se ha proporcionado un ID válido en el formulario
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
}
    // Ejecutar consulta SQL UPDATE para modificar el registro correspondiente
    $sql = "UPDATE company SET nombre = '$nombre' WHERE id_company = $id";
    $result = $db_connect->query($sql);

    if ($result) {
        // Redireccionar de vuelta a la página de listado de tablas
        header("Location: inscripciones.php.php");
        exit();
    } else {
        // Error al actualizar el registro
        echo "Error al actualizar el registro.";
    }
?>