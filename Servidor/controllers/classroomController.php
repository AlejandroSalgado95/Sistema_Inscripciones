<?php

	$conn= DBConnection::conexion();

	require_once("../models/ClassroomModel.php");

	$classroom = new ClassroomModel($conn);



	if ($type == "Chargepage"){

		header('content-type: text/html');

		$allClassrooms = $classroom -> getClassrooms();

		mysqli_close($con);

		require_once("../views/classroomView.php");

	} else if ($type == "Reporte"){

		//$reportInfo = $classroom -> getClassroomsNoAssoc();

		$reportInfo = $classroom -> getClassrooms();

		require_once("downloadService.php");

	}else if ($type == "ModificarBD"){

		
		$modificationType = $_POST["modificationType"];

		if ($modificationType == "Editar"){

			 $id = $_POST["id"];
			 $capacity = $_POST["capacity"];
			 $deptAdmin = $_POST["deptAdmin"];

			 $modifiedRows = 0;

			 
			 for($i= 0; $i < count($id); $i++) {

			 	$modifiedRows = $modifiedRows + ($classroom -> updateTable($id[$i], $capacity[$i], $deptAdmin[$i]) );
			 }

			 echo ($modifiedRows);


		} else if ($modificationType == "Borrar"){

			$id = $_POST["id"];
			$modifiedRows = $classroom -> deleteFromTable($id);
			echo ($modifiedRows);


		} else if ($modificationType == "Agregar"){
			 $id = $_POST["id"];
			 $capacity = $_POST["capacity"];
			 $deptAdmin = $_POST["deptAdmin"];

			$modifiedRows = $classroom -> insertIntoTable($id, $capacity, $deptAdmin);

			echo ($modifiedRows);

		}
	}

	


?>
