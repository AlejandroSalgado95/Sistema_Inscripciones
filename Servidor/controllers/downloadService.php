<?php

//Esto si funciona
/*
header("Content-disposition: attachment; filename=hugedocument.pdf");
header("Content-type: application/pdf");
readfile("hugedocument.pdf");?>*/

//Esto si funciona
/*
header("Content-disposition: attachment; filename=newfile.txt");
header("Content-type: text/plain");
readfile("newfile.txt");?>*/

/*
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];

if (isset($_POST["correo"]))
	$correo = $_POST["correo"];
else 
	$correo = "no hay correo";


if (isset($_POST["contrasena"]))
	$contrasena = $_POST["contrasena"];
else 
	$contrasena = "no hay contrasena";*/


$text = "";
$filename = "";


//Recorre el resultado de un query sin importar cuantas rows y cuantas columns tenga. Eso deberia hacer, pero hay que corregirlo
/*

for($i= 0; $i < count($reportInfo); $i++) { 
    
    for ($j = 0; $j < count ($reportInfo[$i]); $j++){

    	$text = $text + $reportInfo[$i][$j] + " ";



    }
   
   $text = $text + "\n";
    
 } */


if ($action == 'Profesores'){

    $filename = "reporteProfesores.txt";

    if ($tipoReporte == "concurso")
        $text = $text . "Profesores CON clase en el horario: " . (string)$schedule . "\r\n" ; 

    else if ($tipoReporte == "sincurso")
        $text = $text . "Profesores SIN clase en el horario: " . (string)$schedule . "\r\n" ; 

    $text = $text . "\r\n" ;

    for($i= 0; $i < count($reportInfo); $i++) { 

          /*
          if ((string)$reportInfo[$i]["clavemateria"] != null)
             $text = $text . (string)$reportInfo[$i]["clavemateria"] . ", ";
          */ 
          if ((string)$reportInfo[$i]["nomina"] != null)
     	       $text = $text . (string)$reportInfo[$i]["nomina"] . ", "; 
          if ((string)$reportInfo[$i]["nombre"] != null)
             $text = $text . (string)$reportInfo[$i]["nombre"] . " "; 
          if ((string)$reportInfo[$i]["apellido"] != null)
             $text = $text . (string)$reportInfo[$i]["apellido"] . ", "; 
          if ((string)$reportInfo[$i]["telefono"] != null)
             $text = $text . (string)$reportInfo[$i]["telefono"] . ", "; 
          if ((string)$reportInfo[$i]["correo"] != null)
             $text = $text . (string)$reportInfo[$i]["correo"] . "\r\n" ; 

    }
    
    /* for($i= 0; $i < count($reportInfo); $i++) { 
      
        for ($j = 0; $j < count ($reportInfo[$i]); $j++){

            $text = $text . $reportInfo[$i][$j] . " ";



        }
   
       $text = $text . "\r\n";
    
     } */

} else if($action == 'Salones'){

	$filename = "reporteSalones.txt";

	for($i= 0; $i < count($allClassrooms); $i++) { 
          
       $text = $text + (string) $reportInfo[$i]["numero"] + ", ";
       $text = $text + (string) $reportInfo[$i]["capacidad"] + ", ";
       $text = $text + (string) $reportInfo[$i]["deptoadmin"] + "\n" ; 
            
   }

} else if($action == 'Cursos'){

	$filename = "reporteCursos.txt";

	for($i= 0; $i < count($allCourses); $i++) { 
       
       $text = $text + (string)$reportInfo[$i]["materia"] + ", ";
       $text = $text + (string)$reportInfo[$i]["grupo"] + ", "; 
       $text = $text + (string)$reportInfo[$i]["horario"] + ", "; 
       $text = $text + (string)$reportInfo[$i]["horaslaboratorio"] + ", ";
       $text = $text + (string)$reportInfo[$i]["salon"] + ", "; 
       $text = $text + (string)$reportInfo[$i]["nombre"] + ", "; 
       $text = $text + (string)$reportInfo[$i]["correo"] + "\n" ; 
           
    }  

}

$myfile = fopen($filename, "w") or die("Unable to open file!");
//$txt = "whatever3\n";
//fwrite($myfile, $txt);
//$txt = "whatever4\n";
//fwrite($myfile, $txt);
fwrite($myfile, $text);
fclose($myfile);

if( !file_exists($filename) ) 
	die("File not found");

header("Content-disposition: attachment; filename= \"$filename\" ");
header("Content-type: text/plain");
readfile($filename);


?>