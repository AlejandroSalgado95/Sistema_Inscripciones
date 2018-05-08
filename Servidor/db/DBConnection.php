<?php
class DBConnection{

    public static function conexion(){

    	$servername = "den1.mysql3.gear.host";
		$username = "inscripciones";
		$password = "something_1";
		$dbname = "inscripciones";
		$port = "3306";

		$conn = new mysqli($servername, $username, $password, $dbname,$port);
		mysqli_set_charset($conn,"utf8");

        return $conn;
    }

     
}
?>