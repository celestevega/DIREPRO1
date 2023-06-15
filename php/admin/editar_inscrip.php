<?php
include 'conectar.php';

// Verificar si se ha proporcionado un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del registro actual desde la base de datos
    $sql = "SELECT *
    FROM company c
    JOIN sector s ON c.sector = s.id_sector
    JOIN t_empresa t ON c.tipo_empresa = t.id_tcompany WHERE c.id_company = $id";
    $result = $db_connect->query($sql);

    if ($result->num_rows == 1) {
        $rows = $result->fetch_assoc();
        $code = $rows['id_company'];
        $name = $rows['nombre'];
        $cate = $rows['apellido'];
        $dni = $rows['dni'];
        $telef = $rows['telef'];
        $core = $rows['correo'];
        $ruc = $rows['ruc'];
        $type = $rows['tnombre'];
        $sect = $rows['snombre'];
        $razon = $rows['r_social'];
        $tem = $rows['tipo_empresa'];
        $idsec = $rows['sector'];
        $type = $rows['tnombre'];
        $sect = $rows['snombre'];

        // Mostrar el formulario de edición
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="proveedor.css">
            <link rel="stylesheet" href="style.css">
            <title>Editar Registro</title>

        </head>

        <body>
            <div class="container">
                <h1>Editar Registro</h1>
                <div class="content-formu">
                    <form method="post" action="actualizar.php" class="formu">
                        <input type="hidden" name="id" value="<?php echo $code; ?>">
                        <input type="text" name="tx_ruc" id="" class="input" placeholder="ruc" value="<?php echo $ruc; ?>" required>
                        <input type="text" name="tx_rsocial" id="" class="input" placeholder="razon social" value="<?php echo $razon; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        <input type="text" name="tx_nombre" id="" class="input" placeholder="nombre" value="<?php echo $name; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        <input type="text" name="tx_ape" id="" class="input" placeholder="apellido" value="<?php echo $cate; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        <input type="text" name="tx_dni" id="" class="input" placeholder="dni" value="<?php echo $dni; ?>" required>
                        <input type="text" name="tx_telef" id="" class="input" placeholder="telefono" value="<?php echo $telef; ?>" required>
                        <input type="text" name="tx_correo" id="" class="input" placeholder="correo" value="<?php echo $core; ?>" required>
                        <select name="txtcom" class="input" required>
                            <option value="<?php echo $tem; ?>" selected><?php echo $type; ?></option>
                            <?php
                            include 'dispo.php';
                            ?>
                        </select>
                        <select name="txtsec" class="input" required>
                            <option value="<?php echo $idsec; ?>" selected><?php echo $sect; ?></option>
                            <?php
                            include 'dispo2.php';
                            ?>
                        </select><br>
                        <input class="botonadd" type="submit" value="Guardar Cambios">
                    </form>
                </div>
            </div>
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