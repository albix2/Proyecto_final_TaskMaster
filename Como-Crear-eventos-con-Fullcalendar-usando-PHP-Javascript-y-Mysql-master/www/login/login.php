<?php
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
	*/
	include_once('conexion.php');
	mysqli_select_db($conn, "practicas");
	$usuario = $_POST['usuario'];
	$contra = $_POST['contra'];
	

	$sql = "SELECT COUNT(*) FROM usuario where(nombre='$usuario' and contraseña='$contra' )";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);

	if($row[0] > 0 ){
		session_start();
		$_SESSION['nombre'] = $usuario;
		header( 'Location: ../index.php' );
	}
	else{
		header( 'Location: index.php' );		
	}
?>