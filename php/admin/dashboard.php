<?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mypes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
	die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla
$sql = "SELECT dni_cliente, COUNT(*) AS id_usuario, tipo
FROM usuarios
GROUP BY dni_cliente;
";
$resultado = $conn->query($sql);

// Crear un arreglo con los datos obtenidos de la tabla
$datos = array();
if ($resultado->num_rows > 0) {
	while ($fila = $resultado->fetch_assoc()) {
		$datos[] = array(
			"id_usuario" => $fila["id_usuario"],
			"tipo" => $fila["tipo"]);
	}
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Dashboard de Ventas</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
	<div style="width: 800px; margin: auto;">
		<h1>Ventas Totales por Mes</h1>
		<canvas id="grafico"></canvas>
	</div>

	<script>
		// Configuración del gráfico
		var datos = <?php echo json_encode($datos); ?>;
		var etiquetas = [];
		var ventas = [];

		for (var i = 0; i < datos.length; i++) {
			etiquetas.push(datos[i].mes + "/" + datos[i].año);
			ventas.push(datos[i].ventas_totales);
		}

		var ctx = document.getElementById('grafico').getContext('2d');
		var chart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: etiquetas,
				datasets: [{
					label: 'Ventas Totales',
					data: ventas,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script>
</body>

</html>