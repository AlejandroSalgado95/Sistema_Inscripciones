<?php
	//header('Content-type: application/json');
	
	require_once("../models/AdministradorModel.php");

	$conn= DBConnection::conexion();

	if($conn->connect_error)
	{
		header("HTTP/1.1 500 Bad Connection, portal down.");
		die("The server is down, we couldn't stablish the data base connection.");
	}
	else
	{	
		$admin = new AdministradorModel($conn);
		
		$correo = $_POST["correo"];
		$contrasena = $_POST["contrasena"];
		$response = array();

		if($admin -> existeAdmin ($correo, $contrasena) )
		{
			$userExists = true;
			//$response[] = array("correo" => $correo);

			//echo json_encode($response);
			//require_once("../views/professorView.php");

		}
		else
		{	
			$userExists = false;
			//header("HTTP/1.1 406 User not found.");
			//die("Las credenciales provistas son incorrectas");
		}


	}
?>
