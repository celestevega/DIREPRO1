<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <button class="botonadd" onclick="openModal()">AGREGAR NUEVO</button>
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="close" onclick="closeModal()"><i class="fa-solid fa-x"></i></div>

            <form class="content" action="inscripciones.php" method="post" enctype="multipart/form-data">
                <label>Agregar Empresa</label>
                <input type="text" name="tx_ruc" id="" class="input" placeholder="ruc" required><br>
                <input type="text" name="tx_rsocial" id="" class="input" placeholder="razon social" onkeyup="javascript:this.value=this.value.toUpperCase();" required><br>
                <input type="text" name="tx_nombre" id="" class="input" placeholder="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required><br>
                <input type="text" name="tx_ape" id="" class="input" placeholder="apellido" onkeyup="javascript:this.value=this.value.toUpperCase();" required><br>
                <input type="text" name="tx_dni" id="" class="input" placeholder="dni" required><br>
                <input type="text" name="tx_telef" id="" class="input" placeholder="telefono" required><br>
                <input type="text" name="tx_correo" id="" class="input" placeholder="correo" required><br>
                <select name="txtcom" class="input" required>
                    <option value="" disabled selected>Seleccione el tipo de empresa</option>
                    <?php
                    include 'dispo.php';
                    ?>
                </select>
                <select name="txtsec" class="input" required>
                    <option value="" disabled selected>Seleccione el Sector</option>
                    <?php
                    include 'dispo2.php';
                    ?>
                </select><br>
                <!-- <input type="text" name="tx_lugar" id="" class="input" placeholder="correo" required><br> -->
                <label>Provincia</label>
                <select name="lista1" id="lista1">
                    <option value="0">seleccionar provincia</option>
                    <option value="1">HUAMANGA</option>
                    <option value="2">CANGALLO</option>
                    <option value="3">HUANCA SANCOS</option>
                    <option value="4">HUANTA</option>
                    <option value="5">LA MAR</option>
                    <option value="6">LUCANAS</option>
                    <option value="7">PARINACOCHAS</option>
                    <option value="8">PAUCAR DEL SARA SARA</option>
                    <option value="9">SUCRE</option>
                    <option value="10">VICTOR FAJARDO</option>
                    <option value="11">VILCAS HUAMAN</option>
                </select>
                <br>
                <div id="lista2"></div>
                <?php
                include 'conectar.php';
                if (!empty($_POST['tx_ruc']) == "") {
                } else {
                    $nombre = $_POST["tx_nombre"];
                    $apellido = $_POST["tx_ape"];
                    $dni = $_POST["tx_dni"];
                    $telef = $_POST["tx_telef"];
                    $correo = $_POST["tx_correo"];
                    $ruc = $_POST["tx_ruc"];
                    $raz = $_POST["tx_rsocial"];
                    $com = $_POST['txtcom'];
                    $sec = $_POST['txtsec'];
                    $sql_prod = "INSERT INTO company (nombre, apellido, dni, telef, correo, ruc, tipo_empresa, sector, r_social) values('$nombre','$apellido','$dni','$telef','$correo',' $ruc', '$com','$sec','$raz')";
                    $result_prod = $db_connect->query($sql_prod);
                }
                ?>
                <input type="submit" class="submit" value="Agregar">
            </form>
        </div>

    </div>

    <a href="reporte_ins.php" class="gen_reporte" title="Reporte excel"><i class="fa-solid fa-file-excel"></i>Generar reporte</a>


    <div class="content-proves">
        <div class="buscador">
            <ul>
                <li><a href="inscipciones.php">TODOS</a></li>
                <li><a href="prove_ins.php?cat=PESCA" target="frame_cat" onclick="mostrar();">PESCAs</a></li>
                <li><a href="prove_ins.php?cat=ARTESANIA" target="frame_cat" onclick="mostrar();">ARTESANIA</a></li>
                <li><a href="prove_ins.php?cat=SERVICIOS" target="frame_cat" onclick="mostrar();">SERVICIOS</a></li>
                <li><a href="prove_ins.php?cat=NUBE" target="frame_cat" onclick="mostrar();">NUBE</a></li>
            </ul>
            <form action="inscripciones.php" method="post">
                <input type="text" name="tx_prove" id="" class="input" placeholder="Escriba el proveedor" required>
                <input type="submit" value="Buscar" class="submit">
            </form>
        </div>
        <table id="tabla">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>RUC</th>
                <th>Tipo de empresa</th>
                <th>Sector</th>
                <th>Razon Social</th>
                <th>acciones</th>
            </thead>
            <?php
            include 'conectar.php';
            if (!empty($_POST['tx_prove']) == "") {
                $sql_prod = "SELECT *
                FROM company c
                JOIN sector s ON c.sector = s.id_sector
                JOIN t_empresa t ON c.tipo_empresa = t.id_tcompany";
                $result_prod = $db_connect->query($sql_prod);
                if ($result_prod->num_rows > 0) {
                    while ($rows = $result_prod->fetch_assoc()) {
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
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td>' . $code . '</td>';
                        echo '<td>' . $name . '</td>';
                        echo '<td>' . $cate . '</td>';
                        echo '<td>' . $dni . '</td>';
                        echo '<td>' . $telef . '</td>';
                        echo '<td>' . $core . '</td>';
                        echo '<td>' . $ruc . '</td>';
                        echo '<td>' . $type . '</td>';
                        echo '<td>' . $sect . '</td>';
                        echo '<td>' . $razon . '</td>';
                        echo '<td>
                        <a href="editar_inscrip.php?id=' . $code . '"><i class="fa fa-edit" style="color: white;"></i></a>
                        <button style="background-color: transparent; border: 0;" onclick="confirmDelete(' . $code . ')"><i class="fa fa-trash" style="color: white;"></i></button>
                        </td>';
                        echo '</tr>';
                        echo '</tbody>';
                    }
                }
            } else {
                /*                 $prove = $_POST['tx_prove'];
                $sql_prod = "SELECT * FROM company WHERE nombre LIKE '%" . $prove . "%'";
                $result_prod = $db_connect->query($sql_prod);
                if ($result_prod->num_rows > 0) {
                    while ($rows = $result_prod->fetch_assoc()) {
                        $code = $rows['id_company'];
                        $name = $rows['nombre'];
                        $cate = $rows['apellido'];
                        $dni = $rows['DNI'];
                        $telef = $rows['Telef'];
                        $core = $rows['correo'];
                        $ruc = $rows['ruc'];
                        $type = $rows['tipo_empresa'];
                        $sect = $rows['sector'];
                        $razon = $rows['r_social'];
                        echo '
                                <tr>
                                <td>' . $code . '</td>
                                    <td class="nombres">' . $name . '</td>
                                    <td>' . $cate . '</td>
                                    <td>' . $dni . '</td>
                                    <td>' . $telef . '</td>
                                    <td>' . $core . '</td>
                                    <td>' . $ruc . '</td>
                                    <td>' . $type . '</td>
                                    <td>' . $sect . '</td>
                                    <td>' . $razon . '</td>

                                </tr>
                                ';
                    }
                } else {
                    echo '
                                <tr>
                                    <td colspan=7>
                                        <div class="nohay">
                                            <img src="../../img/vacio.png" alt="vacio">
                                            <p>No hay proveedores que coincidan con "' . $prove . '"</p>
                                        </div>
                                    </td>
                                </tr>
                            ';
                }*/
            }
            ?>
        </table>
        <iframe src="" frameborder="0" name="frame_cat" id="Iframe"></iframe>
    </div>

</body>

</html>
<script>
    function confirmDelete() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el dato.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteData();
            }
        });
    }

    function deleteData() {
        $.ajax({
            url: 'elim_inscrip.php',
            type: 'POST',
            data: {
                id: <?= $code ?>
            },
            success: function(response) {
                Swal.fire({
                    title: 'Éxito',
                    text: 'El dato se ha eliminado correctamente.',
                    icon: 'success'
                }).then(function() {
                    window.location.href = 'inscripcion.php';
                });
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Ha ocurrido un error al eliminar el dato.',
                    icon: 'error'
                });
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //$('#lista1').val(2);
        recargarLista();

        $('#lista1').change(function() {
            recargarLista();
        });
    })
</script>
<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "datos.php",
            data: "provincia=" + $('#lista1').val(),
            success: function(r) {
                $('#lista2').html(r);
            }
        });
    }
</script>