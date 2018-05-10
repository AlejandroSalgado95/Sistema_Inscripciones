<!DOCTYPE html>
<html lang="es">
    <head>

        <!--<link rel="stylesheet" type="text/css" href="./css/login.css">-->
        <style>
            <?php include '../views/css/general.css'; ?>
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="../views/js/assignation.js"></script>
        
        
        <!--
        <script>
            <?php //include 'js/menu.js'; ?>
        </script>
        -->

        <meta charset="UTF-8" />
        <title>Asignaciones</title>

    </head>
    <body>

        <div id="headerDiv">
            
            <!--
            <img src="img/estrella2.png" alt="logo" height="42" width="42">
            -->
            <img src="../views/img/estrella2.png" height="50" width="50">
            <span>
                Universidad Random
            </span>

            <br>

            <span class="slogan">
                Sistema de inscripciones
            </span>
        
         </div>
    
         <div class="menuDiv">

            <!-- ../../Servidor/controllers/index.php -->
            <form action ="index.php" method = "post">
                <input type = "submit" name = "action" id="bt1" class="menuBtn" value = "Profesores"> 
                <input type = "text" name = "type" value = "Chargepage" hidden>
            </form>

            <form action ="index.php" method = "post">
                <input type = "submit" name = "action" id="bt2" class="menuBtn" value = "Salones">
                <input type = "text" name = "type" value = "Chargepage" hidden>
            </form>

             <form action ="index.php" method = "post">
                <input type = "submit" name = "action" id="bt3" class="menuBtn" value = "Asignaciones" >
                <input type = "text" name = "type" value = "Chargepage" hidden>
            </form>

            <form action ="index.php" method = "post">
                <input type = "submit" name = "action" id="bt3" class="menuBtn" value = "Cursos" >
                <input type = "text" name = "type" value = "Chargepage" hidden>
            </form>

            <form action ="index.php" method = "post">
                <input type = "submit" name = "action" id="bt4" class="menuBtn" value = "Salir" >
                <!--<input type = "text" name = "action" value = "logout" hidden>-->
            </form>

            <!--
            <button id="bt2" class="menuBtn" > Salones </button>
            <button id="bt3" class="menuBtn" > Cursos </button>
            <button id="bt4" class="menuBtn" > Logout</button>
            -->
         </div>

        <br>
        
        <button id = "settings" class = "option gear"> 
            <img src="../views/img/gear.png" height="30 " width="30">
        </button>

        <button id = "add" class = "option add"> 
            <img src="../views/img/plus.png" height="30 " width="30">
        </button>

        <button id = "delete" class = "option delete"> 
            <img src="../views/img/delete10.png" height="30 " width="30">
        </button>
        
        <div id = "tableDiv">
        <table id = "assignationsTable" align = "center">
             <tr>
                 <th>Materia</th>
                 <th>Grupo</th>
                 <th>Horario</th>
                 <th>Profesor</th>
                 <th>Correo</th>
                 <th>Porcentaje</th>
             </tr>
            <?php for($i= 0; $i < count($allAssignations); $i++) { ?> 
            <tr>
                <td><?php echo $allAssignations[$i]["materia"] ; ?></td>
                <td><?php echo $allAssignations[$i]["grupo"] ; ?></td>
                <td><?php echo $allAssignations[$i]["horario"] ; ?></td>
                <td><?php echo $allAssignations[$i]["nombre"] ; ?></td>
                <td><?php echo $allAssignations[$i]["correo"] ; ?></td>
                <td><?php echo $allAssignations[$i]["porcentaje"] ; ?></td>
            </tr> 
            <?php } ?> 
        </table>
        </div>
        
        <br>
        <br>
        
          <div id = "newRowDiv" >
            <fieldset id = "newRowFieldset" hidden>
                <legend>Nuevo profesor</legend>
                    
                    
                <p>Materia</p>

                <select id = "dropDownMateria" name = "materia">
                    <?php for($i= 0; $i < count($assignationNames); $i++) { ?> 
                                 
                        <option value=   "<?php echo $assignationNames[$i]["materia"] ; ?>"   ><?php echo $assignationNames[$i]["materia"] ; ?></option>
                    
                    <?php } ?> 
                </select>

                <!-- <input id = "id" type="text" > <span class ="error" name="err">*</span> -->

                <br><br>

                <p>Grupo</p>
                
                <select id = "dropDownGrupo" name = "grupo">
                    <?php for($i= 1; $i < 10; $i++) { ?> 
                                 
                        <option value=   "<?php echo $i;?>  "   ><?php echo $i;?></option>
                    
                    <?php } ?> 
                </select>
                
                <!-- <input id = "name" type="text">  <span class ="error" name="err">*</span> -->

                <br><br>

                <p>Profesor</p>
                
                <select name = "professor">
                    <?php for($i= 0; $i < count($nominas); $i++) { ?> 
                                 
                        <option value=   "<?php echo $nominas[$i]["nomina"] ; ?>"   ><?php echo $nominas[$i]["nomina"] ; ?></option>
                    
                    <?php } ?> 
                </select>
                
                
                 <!-- <input id = "lastname" type="text">  <span class ="error" name="err">*</span> -->
                <br><br>
                <button id = "saveNewRecord" class = 'option' >Guardar</button>


             </fieldset>
             <br>
             <br>


        </div>

        <br>

        <br>
        <br>

        <!-- ../../Servidor/controllers/index.php -->
        <form action ="index.php" method = "post">
            <input type ="submit" name = "type" class = "btn" value = "Reporte" >
            <input type = "text" name = "action" value = "Cursos" hidden>
        </form>

        <br>
        

    </body>
</html>