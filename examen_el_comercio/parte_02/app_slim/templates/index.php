<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title></title>
</head>
<body>
	<h1>List of Employees</h1>
	<br />
	<form method="post" action="buscar_empleado.php">
		<label>Search: </label>
		<input type="text" name="email" placeholder="Enter an email" size="50" autofocus maxlength="200" required />
		<input type="submit" name="buscar" value="Search" />
		<br /><br />
	</form>

	<table border="1">
		<thead>
			<tr>
				<th style="display:none;">Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				<th>Salary</th>
				<th>See detail</th>
			</tr>
		</thead>
		<tbody>
		<?php		
		foreach ($empleados as $clave => $valor) 
		{
			?>
			<tr>	
				<td style="display:none;"><?php echo $valor['id'] ?></td>		
				<td><?php echo $valor['name']?></td>
				<td><?php echo $valor['email']?></td>
				<td><?php echo $valor['position']?></td>
				<td><?php echo $valor['salary']?></td>				
				<td>
				<?php
					 $id = $valor['id'];
					 echo "<a href='detalle_empleado.php?id=$id'>See detail</a>"; 
			    ?>					
				</td>
			</tr>
			<?php			
		}		
		?>
		</tbody>
		<tfoot>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				<th>Salary</th>
				<th>See detail</th>
			</tr>			
		</tfoot>
	</table>
</body>
</html>

