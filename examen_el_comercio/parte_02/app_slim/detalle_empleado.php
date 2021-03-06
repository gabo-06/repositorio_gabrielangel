<?php 
include 'funciones.php';

$id = $_GET['id'];

$empleados = obtenerEmpleados();

foreach ($empleados as $clave => $valor) // Recorre el arreglo de empleados para buscar el id del empleado seleccionado...
{
	if ($valor['id'] ==	$id) // ... cuando lo encuentra...
	{
		$empleado = $valor; // ... almacena la variable $valor (empleado actual en la iteración) en la variable $empleado...
		break; // ... y aborta el bucle.
	}
}
?>

<table border="1">
	<thead>
		<tr>
			<th colspan="2">Employee Detail</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>name</td><td><?php echo $empleado['name'] ?></td>
		</tr>
		<tr>
			<td>email</td><td><?php echo $empleado['email'] ?></td>
		</tr>
		<tr>
			<td>phone</td><td><?php echo $empleado['phone'] ?></td>
		</tr>
		<tr>
			<td>address</td><td><?php echo $empleado['address'] ?></td>
		</tr>
		<tr>
			<td>position</td><td><?php echo $empleado['position'] ?></td>
		</tr>
		<tr>
			<td>salary</td><td><?php echo $empleado['salary'] ?></td>
		</tr>
		<tr>
			<td rowspan="5">skills</td>
			<td>
			<ul type="circle">
			<?php 
			foreach ($empleado['skills'] as $clave => $valor) 
			{
			?>
				<li>
					<?php
						echo $valor['skill'];
					?>
				</li>
				
			<?php
			}
			?>
			</ul>
			</td>
		</tr>
	</tbody>
</table>

<br /><br />
<a href="index.php">Back</a>