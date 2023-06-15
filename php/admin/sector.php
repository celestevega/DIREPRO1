<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proveedor.css">
    <script src="https://kit.fontawesome.com/a8527aea5d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="content-formu">
            <form class="formu" action="sector.php" method="post" enctype="multipart/form-data">
                <h1>Agregar Sector</h1>
                <input type="text" name="tx_nombre" id="" class="input" placeholder="Nombre del sector" onkeyup="javascript:this.value=this.value.toUpperCase();" required>

                <?php
                include 'conectar.php';
                if (!empty($_POST['tx_nombre']) == "") {
                } else {
                    $nombre = $_POST["tx_nombre"];
                    $sql_prod = "INSERT INTO sector (snombre) values('$nombre')";
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
            <div class="buscador">
                <form action="sector.php" method="post">
                    <input type="text" name="tx_sect" id="" class="input" placeholder="Escriba el usuario" required>
                    <input type="submit" value="Buscar" class="submit">
                </form>
            </div>
            <table id="tabla">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>acciones</th>
                    </tr>
                </thead>
                <?php
                include 'conectar.php';
                if (!empty($_POST['tx_sect']) == "") {
                    $sql_prod = "SELECT * FROM sector";
                    $result_prod = $db_connect->query($sql_prod);
                    if ($result_prod->num_rows > 0) {
                        while ($rows = $result_prod->fetch_assoc()) {
                            $code = $rows['id_sector'];
                            $name = $rows['snombre'];
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td>' . $code . '</td>';
                            echo '<td>' . $name . '</td>';
                            echo '<td>
                            <a href="editar.php?id=' . $code . '"><i class="fa fa-edit" style="color: white;"></i></a>
                            <a hhref="eliminar.php?id=' . $code . '"><i class="fa fa-trash" style="color: white;"></i></a>
                            </td>';
                            echo '</tr>';
                            echo '</tbody>';
                        }
                    }
                } else {
                    /*                         $sect=$_POST['tx_sect'];
                        $sql_prod ="SELECT * FROM sector WHERE nombre LIKE '%".$sect."%'order by tipo asc";  
                        $result_prod = $db_connect -> query($sql_prod);
                        if($result_prod -> num_rows > 0) {
                            while ( $rows = $result_prod -> fetch_assoc() ) {
                                $code = $rows['id_sector'];
                                $name = $rows['snombre'];
                                echo'
                                 <tr>
                                     <td>'.$code.'</td>
                                     <td class="nombres">'.$name.'</td>
                                 </tr>
                                ';
                           }
                        } 
                        else{
                            echo'
                                <tr>
                                    <td colspan=7>
                                        <div class="nohay">
                                            <img src="../../img/vacio.png" alt="vacio">
                                            <p>No hay sectores que coincidan con "'.$sect.'"</p>
                                        </div>
                                    </td>
                                </tr>
                            ';
                        } */
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

        function mostrar() {
            tabla.style.display = "none";
            frame.style.display = "block";
        }
    </script>
</body>

</html>