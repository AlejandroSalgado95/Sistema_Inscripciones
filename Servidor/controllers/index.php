<?php
	//header('Content-type: application/json');
	
	require_once("../db/DBConnection.php");

	$action = $_POST["action"];
	$type =  $_POST["type"];
	$userExists = false;


	if ($action == "Ingresar"){

		require_once("loginService.php");

		if ($userExists){
			
			require_once("professorController.php");

		} else{	

			header("HTTP/1.1 406 User not found.");
			die("Las credenciales provistas son incorrectas.");
			
			//header('content-type: text/html');
			//require_once("../views/loginView.php");
		}
		

	}else if ($action == 'Profesores'){

		require_once("professorController.php");

	}
	
	else if ($action == 'Salones'){

		require_once("classroomController.php");

	}
	else if ($action == 'Asignaciones'){

		require_once("assignationController.php");

	}
	else if ($action == 'Cursos'){

		require_once("courseController.php");

	}
	else if ($action == 'Salir'){

		header('content-type: text/html');

		require_once("../views/loginView.php");

	}
	else{

		header("HTTP/1.1 406 User not found.");
		die("La accion provista es incorrecta.");
	}

?>
