<?php
include 'conectar.php';

// Verificar si se ha proporcionado un ID válido en la URL
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];

    // Ejecutar consulta SQL DELETE para eliminar el registro correspondiente
    $sql = "DELETE FROM company WHERE id_company = $id";
    $result = $db_connect->query($sql);

    if ($result) {
        // Redireccionar de vuelta a la página de listado de tablas
        header("Location: inscripciones.php");
        exit();
    } else {
        // Error al eliminar el registro
        echo "Error al eliminar el registro.";
    }
} else {
    // No se proporcionó un ID válido en la URL
    echo "ID de registro inválido.";
}
?>






