<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Tipo de empresa</title>
</head>
<body>
    <div class="container">
        <a href="repor_proves.php" class="gen_reporte" title="Reporte excel"><i class="fa-solid fa-file-excel"></i>Generar reporte</a>
        <div class="content-formu">
            <form class="formu" action="tipos_empresa.php" method="post" enctype="multipart/form-data">
                <h1>Tipo de empresa</h1>
                <input type="text" name="tx_nombre" id="" class="input" placeholder="Tipo de empresa" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                <?php
                    include 'conectar.php';
                    if(!empty($_POST['tx_nombre']))
                    {
                        $nombre = $_POST['tx_nombre'];
                        $sql_prod = "INSERT INTO t_empresa(tnombre) VALUES('$nombre')";  
                        $result_prod = $db_connect->query($sql_prod);
                    }       
                ?>
                <input type="submit" class="submit" value="Agregar">
            </form>
            <div class="img">
                <img src="../../img/undraw1.svg" alt="">
            </div>
        </div>
        <div class="content-proves">
            <table id="tabla">
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
                <?php
                    include 'conectar.php';
                    if(empty($_POST['tx_prove']))
                    {  
                        $sql_prod = "SELECT * FROM t_empresa";  
                        $result_prod = $db_connect->query($sql_prod);
                        if($result_prod->num_rows > 0) {
                            while ($rows = $result_prod->fetch_assoc()) {
                                $code = $rows['id_tcompany'];
                                $name = $rows['tnombre'];
                                echo '
                                    <tr>
                                        <td>'.$code.'</td>
                                        <td class="nombres">'.$name.'</td>
                                        <td>
                                            <a href="?action=editar&id='.$code.'"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <a href="?action=eliminar&id='.$code.'"><i class="fas fa-trash" aria-hidden="true" style="color: white;"></i></a>
                                        </td>
                                    </tr>
                                ';
                            }
                        } 
                    }
                    else
                    {
/*                         $prove = $_POST['tx_prove'];
                        $sql_prod = "SELECT * FROM t_empresa WHERE nombre LIKE '%".$prove."%'";  
                        $result_prod = $db_connect->query($sql_prod);
                        if($result_prod->num_rows > 0) {
                            while ($rows = $result_prod->fetch_assoc()) {
                                $code = $rows['id_tcompany'];
                                $name = $rows['tnombre'];
                                
                                echo '
                                    <tr>
                                        <td>'.$code.'</td>
                                        <td class="nombres">'.$name.'</td>
                                    </tr>
                                ';
                           }
                        } 
                        else{
                            echo '
                                <tr>
                                    <td colspan=7>
                                        <div class="nohay">
                                            <img src="../../img/vacio.png" alt="vacio">
                                            <p>No hay proveedores que coincidan con "'.$prove.'"</p>
                                        </div>
                                    </td>
                                </tr>
                            ';
                        } */
                    }   

                    // Función para editar el tipo de empresa
                    if(isset($_GET['action']) && $_GET['action'] == 'editar' && isset($_GET['id'])) {
                        $edit_id = $_GET['id'];
                        $sql_edit = "SELECT * FROM t_empresa WHERE id_tcompany = $edit_id";
                        $result_edit = $db_connect->query($sql_edit);
                        $row_edit = $result_edit->fetch_assoc();
                        $edit_nombre = $row_edit['tnombre'];

                        echo '
                            <form action="" method="post">
                                <input type="text" name="edit_nombre" value="'.$edit_nombre.'" required>
                                <input type="hidden" name="edit_id" value="'.$edit_id.'">
                                <input class="botonadd " type="submit" name="editar" value="Guardar">
                            </form>
                        ';
                    }

                    // Función para actualizar el tipo de empresa
                    if(isset($_POST['editar'])) {
                        $edit_id = $_POST['edit_id'];
                        $edit_nombre = $_POST['edit_nombre'];

                        $sql_update = "UPDATE t_empresa SET tnombre = '$edit_nombre' WHERE id_tcompany = $edit_id";
                        $result_update = $db_connect->query($sql_update);

                        if($result_update) {
                            header('Location: tipos_empresa.php'); // Redireccionar después de actualizar
                        } else {
                            echo 'Error al actualizar el tipo de empresa';
                        }
                    }

                    // Función para eliminar el tipo de empresa
                    if(isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id'])) {
                        $delete_id = $_GET['id'];
                        $sql_delete = "DELETE FROM t_empresa WHERE id_tcompany = $delete_id";
                        $result_delete = $db_connect->query($sql_delete);

                        if($result_delete) {
                            header('Location: tipos_empresa.php'); // Redireccionar después de eliminar
                        } else {
                            echo 'Error al eliminar el tipo de empresa';
                        }
                    }
                ?>
            </table>
            <iframe src="" frameborder="0" name="frame_cat" id="Iframe"></iframe>
        </div>
    </div>
    <script>
        // Selecting the iframe element
        let frame = document.getElementById("Iframe");
          
        /* // Adjusting the iframe height onload event
        frame.onload = function()
        // function execute while load the iframe
        {
          // set the height of the iframe as 
          // the height of the iframe content
          frame.style.height = 
          frame.contentWindow.document.body.scrollHeight + 'px';
           
  
         // set the width of the iframe as the 
         // width of the iframe content
         frame.style.width  = 
         frame.contentWindow.document.body.scrollWidth+'px';
              
        }  */
        let tabla = document.getElementById("tabla");
        function mostrar(){
            tabla.style.display = "none";
            frame.style.display = "block";
        }
    </script>
</body>
</html>
