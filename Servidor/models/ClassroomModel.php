<?php
class ClassroomModel{
    private $db;
    private $classrooms;
 
    public function __construct($con){
        $this->db= $con;
        $this->classrooms = array();
    }
    
    public function getClassrooms(){
        $consult=$this->db->query("SELECT * FROM salon");
        while($row=$consult->fetch_assoc()) {
            $this->classrooms[]= array("numero" => $row[Numero], "capacidad" => $row[Capacidad], "deptoadmin" => $row[DeptoAdministrador]);
        }
        return $this->classrooms;
    }

    public function getClassroomsHours($hours){

        /*
        $consult=$this->db->query("SELECT salon.Numero,salon.Capacidad,salon.DeptoAdministrador 
                                   FROM salon, curso 
                                   WHERE salon.Numero = curso.NumeroSalon 
                                   GROUP BY salon.Numero
                                   HAVING max( CASE curso.Horario  WHEN '$hours' THEN 1 ELSE 0 END ) = 0 ");*/

        $consult=$this->db->query("SELECT distinct salon.Numero,salon.Capacidad,salon.DeptoAdministrador 
                                   FROM salon 
                                   WHERE salon.Numero NOT IN 
                                                            (SELECT salon.Numero 
                                                             FROM salon JOIN curso ON salon.Numero = curso.NumeroSalon 
                                                             WHERE curso.Horario = '$hours')");

        while($row=$consult->fetch_assoc()) {
            $this->classrooms[]= array("numero" => $row[Numero], "capacidad" => $row[Capacidad], "deptoadmin" => $row[DeptoAdministrador]);
        }

        return $this->classrooms;
    }

    public function getHours(){
        $consult=$this->db->query("SELECT * FROM curso");
        while($row=$consult->fetch_assoc()) {
            $hours[]= array("hora" => $row[Horario]);
        }
        return $hours;
    }




    public function updateTable($id, $capacity, $deptAdmin){

        $consult=$this->db->query(" UPDATE  salon 
                                    SET salon.Capacidad = '$capacity', salon.DeptoAdministrador = '$deptAdmin'
                                    WHERE salon.Numero = '$id' 
                                 ");


        if(mysqli_affected_rows($this->db) >0 )
            return 1;
        else
            return 0;
    }

    public function deleteFromTable($id){


        $consult=$this->db->query("DELETE FROM salon
                                    WHERE salon.Numero = '$id'
                                        AND salon.Numero NOT IN (
                                                                    SELECT tNumero from (SELECT salon.Numero as tNumero
                                                                                         FROM curso,salon
                                                                                         WHERE salon.Numero = '$id' AND curso.NumeroSalon = salon.Numero
                                                                                         ) as c
                                                                    )"

        );

        if(mysqli_affected_rows($this->db) > 0 )
            return 1;
        else
            return 0;

    }

    public function insertIntoTable($id, $capacity, $deptAdmin) {

        $consult1=$this->db->query("SELECT * 
                                    FROM salon
                                    WHERE salon.Numero = '$id'"
        );

        if ($consult1 -> num_rows == 0){


            $consult2=$this->db->query("INSERT INTO salon VALUES ('$id', '$capacity', '$deptAdmin') ");

            return 1;

        } else {

            return 0;
        }


    }


    /*
    public function getClassroomsNoAssoc(){
        $consult=$this->db->query("SELECT * FROM Salon");
        while($row=$consult->fetch_assoc()) {
            $this->classrooms[]= array($row[Numero], $row[Capacidad], $row[DeptoAdministrador]);
        }
        return $this->classrooms;
    }*/
}
?>