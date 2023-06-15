<?php
include 'conectar.php';

// Verificar si se ha proporcionado un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del registro actual desde la base de datos
    $sql = "SELECT * FROM sector WHERE id_sector = $id";
    $result = $db_connect->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = $row['snombre'];

        // Mostrar el formulario de edición
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="proveedor.css">
            <title>Editar Registro</title>

        </head>
        <body>
            <h1>Editar Registro</h1>

            <form method="post" action="actualizar.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text" name="nombre" id="" class="input" placeholder="Nombre del sector" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                <input type="submit" value="Guardar Cambios">
            </form>
        </body>
        </html>
        <?php
    } else {
        // No se encontró el registro correspondiente en la base de datos
        echo "Registro no encontrado.";
    }
} else {
    // No se proporcionó un ID válido en la URL
    echo "ID de registro inválido.";
}
?>





