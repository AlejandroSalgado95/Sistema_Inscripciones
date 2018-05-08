<?php

	$conn= DBConnection::conexion();
	
	require_once("../models/CourseModel.php");

	$course = new CourseModel($conn);



	if ($type == "Chargepage"){

		header('content-type: text/html');

		$allCourses = $course -> getCourses();

		mysqli_close($con);

		require_once("../views/courseView.php");

	} else if ($type == "Reporte"){

		$reportInfo = $course -> getCourses();

		require_once("downloadService.php");

	}


?>
