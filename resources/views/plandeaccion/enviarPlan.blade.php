<?php

	$conexion = mysqli_connect('localhost','root','','plan_de_accion');
	$nombre=$_POST['nombrePlan'];
	$descripcion=$_POST['descripcionPlan'];

	$sql="INSERT into plan (nombre,descripcion) values ('$nombre','$descripcion')";

	echo mysqli_query($conexion,$sql);
?>