<!DOCTYPE html>
<html lang="es">
    <head>

        <!--<link rel="stylesheet" type="text/css" href="./css/login.css">-->
        <style>
            <?php include '../views/css/general.css'; ?>
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="../views/js/professor.js"></script> 

        <!--
        <script>
            <?php //include 'js/menu.js'; ?>
        </script>
        -->

        <meta charset="UTF-8" />
        <title>Profesores</title>

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
            <table id = "professorTable" align = "center">
                 <tr>
                     <th>Nomina</th>
                     <th>Nombre</th>
                     <th>Apellido</th>
                     <th>Telefono</th>
                     <th>Correo</th>
                 </tr>
                <?php for($i= 0; $i < count($allProfessors); $i++) { ?> 
                <tr>
                    <td><?php echo $allProfessors[$i]["nomina"] ; ?></td>
                    <td><?php echo $allProfessors[$i]["nombre"] ; ?></td>
                    <td><?php echo $allProfessors[$i]["apellido"] ; ?></td>
                    <td><?php echo $allProfessors[$i]["telefono"] ; ?></td>
                    <td><?php echo $allProfessors[$i]["correo"] ; ?></td>
                </tr> 
                <?php } ?> 
            </table>
        </div>

        <br>
        <button id = "save" class = "option save" hidden> 
            Guardar
        </button>


        <br>
        <br>

        <div id = "newRowDiv" >
            <fieldset id = "newRowFieldset" hidden>
                <legend>Nuevo profesor</legend>
                    
                    
                <p>Nomina</p>


                <input id = "id" type="text" > <span class ="error" name="err">*</span>

                <br><br>

                <p>Nombres</p>
                <input id = "name" type="text">  <span class ="error" name="err">*</span>

                <br><br>

                <p>Apellidos</p>
                <input id = "lastname" type="text">  <span class ="error" name="err">*</span>
                

                <br><br>

                <p>Teléfono</p>
                <input id = "phone" type="text">  <span class ="error" name="err">*</span>
                

                <br><br>

                <p>Correo</p>
                <input id = "email" type="text">  <span class ="error" name="err">*</span>
                
                <br><br>
                <button id = "saveNewRecord" class = 'option' >Guardar</button>

             </fieldset>
             <br>
             <br>


        </div>

        <br>


        <!-- ../../Servidor/controllers/index.php -->
        <form action ="index.php" method = "post">

            <select name = "tiporeporte" >
                <option value = "sincurso">  Sin curso </option>
                <option value = "concurso"> Con curso </option>
            </select>

            <select name = "horario">
                <?php for($i= 0; $i < count($schedules); $i++) { ?> 
                             
                    <option value=   "<?php echo $schedules[$i]["horario"] ; ?>"   >      <?php echo $schedules[$i]["horario"] ; ?>       </option>
                
                <?php } ?> 
            </select>


            <input type ="submit" name = "type" class = "option" value = "Reporte" >
            <input type = "text" name = "action" value = "Profesores" hidden>
            <br>
            <br>

        </form>

    </body>
</html>