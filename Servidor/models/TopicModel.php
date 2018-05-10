<?php
class TopicModel{
    private $db;
    private $Topics;
 
    public function __construct($con){
        $this->db= $con;
        $this->Topics = array();
    }
    
    public function getTopics(){
        $consult=$this->db->query("SELECT * FROM Materia");
        while($row=$consult->fetch_assoc()) {
            $this->Topics[]= array("clave" => $row[Clave], "nombre" => $row[Nombre], "horaslaboratorio" => $row[HorasLaboratorio]);
        }
        return $this->Topics;
    }

  
}
?>