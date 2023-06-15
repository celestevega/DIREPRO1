<table border=1>
    <caption>REPORTE DE INSCRIPCIONES</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Tipo de empresa</th>
            <th>Sector</th>
            <th>Razon Social</th>
        </tr>
    </thead>
    <?php
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment;filename=reporte_proveedores.xls");
    include 'conectar.php';
    $sql_prod = "SELECT *
    FROM company c
    JOIN sector s ON c.sector = s.id_sector
    JOIN t_empresa t ON c.tipo_empresa = t.id_tcompany";
    $result_prod = $db_connect->query($sql_prod);
    if ($result_prod->num_rows > 0) {
        while ($rows = $result_prod->fetch_assoc()) {
            echo '<tbody>';
            echo '<tr>';
            echo '<td>' . $rows['id_company'] . '</td>';
            echo '<td>' . $rows['nombre'] . '</td>';
            echo '<td>' . $rows['apellido'] . '</td>';
            echo '<td>' . $rows['dni'] . '</td>';
            echo '<td>' . $rows['correo'] . '</td>';
            echo '<td>' . $rows['telef'] . '</td>';
            /* echo '<td>' . $rows['ruc'] . '<td>'; */
            echo '<td>' . $rows['tnombre'] . '</td>';
            echo '<td>' . $rows['snombre'] . '</td>';
            echo '<td>' . $rows['r_social'] . '</td>';
            echo '</tr>';
            echo '</tbody>';
        }
    }
    ?>
</table>