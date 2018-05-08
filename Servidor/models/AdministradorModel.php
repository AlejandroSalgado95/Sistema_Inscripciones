<?php
class AdministradorModel{
    private $db;
 
    public function __construct($con){
        $this->db= $con;
    }
    
    public function existeAdmin($correo, $contrasena){
        $consult=$this->db->query("SELECT * FROM Administrador WHERE Correo = '$correo' AND Contrasena ='$contrasena'");
        
        if ($consult -> num_rows > 0)
            return true;
        else
            return false;
    }
}
?>