<?php
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
	*/
	include_once('conexion.php');
	mysqli_select_db($conn, "practicas");
	$usuario = $_POST['usuario'];
	$contra = $_POST['contra'];
	

	$sql = "SELECT COUNT(*) FROM usuario WHERE (nombre COLLATE utf8mb4_bin ='$usuario' AND contraseña COLLATE utf8mb4_bin ='$contra')";


	// echo s$sql;
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($res);

	if ($row[0] > 0) {
		session_start();
		// echo $usuario;
		$_SESSION['nombre'] = $usuario;
		header('Location: ../calendario/calendario.php?no=1');
	} else {
		header('Location: index.php');		
	}
?>
