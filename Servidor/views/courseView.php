<!DOCTYPE html>
<html lang="es">
    <head>

        <!--<link rel="stylesheet" type="text/css" href="./css/login.css">-->
        <style>
            <?php include '../views/css/general.css'; ?>
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../views/js/course.js"></script>

        <!--
        <script>
            <?php //include 'js/menu.js'; ?>
        </script>
        -->

        <meta charset="UTF-8" />
        <title>Cursos</title>

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
            <table id = "courseTable" align = "center">
                 <tr>
                     <th>Materia</th>
                     <th>Grupo</th>
                     <th>Horario</th>
                     <th>Laboratorio</th>
                     <th>Salon</th>
                     <th>Idioma</th>
                     <th>Tipo</th>
                 </tr>
                <?php for($i= 0; $i < count($allCourses); $i++) { ?> 
                <tr> 
                    <td><?php echo $allCourses[$i]["materia"] ; ?></td>
                    <td><?php echo $allCourses[$i]["grupo"] ; ?></td>
                    <td><?php echo $allCourses[$i]["horario"] ; ?></td>
                    <td><?php echo $allCourses[$i]["horaslaboratorio"] ; ?></td>
                    <td><?php echo $allCourses[$i]["salon"] ; ?></td>
                    <td><?php echo $allCourses[$i]["idioma"] ; ?></td>
                    <td><?php echo $allCourses[$i]["tipogrupo"] ; ?></td>
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
                <legend>Nuevo curso</legend>
                    
                    
                <p>Materia</p>


                 <select id= "materiadato" name = "materiadato">
                        <?php for($i= 0; $i < count($allTopics); $i++) { ?> 
                                     
                            <option value=   '<?php echo $allTopics[$i]["clave"] ; ?>'   >      <?php echo $allTopics[$i]["nombre"] ; ?>       </option>
                        
                        <?php } ?> 
                 </select><span class ="error" name="err">*</span>

                <br><br>

                <p>Horario</p>
                <input id = "horariodato" type="text">  <span class ="error" name="err">*</span>

                <br><br>

                <p>Laboratorio</p>
                <input id = "laboratoriodato" type="text">  <span class ="error" name="err">*</span>
                

                <br><br>

                <p>Salon</p>
                <select id = "salondato" name = "salondato">
                    <?php for($i= 0; $i < count($allClassrooms); $i++) { ?> 
                                 
                        <option value=   '<?php echo $allClassrooms[$i]["numero"] ; ?>'  >      <?php echo $allClassrooms[$i]["numero"] ; ?>       </option>
                    
                    <?php } ?> 
                </select> <span class ="error" name="err">*</span>
                

                <br><br>

                <p>Idioma</p>
                 <select id = "idiomadato" name = "idiomadato" >
                    <option value = "Espanol">Español</option>
                    <option value = "Ingles">Ingles</option>
                </select>  <span class ="error" name="err">*</span>
                
                <br><br>

                <p>Tipo</p>
                <select id = "tipodato" name = "tipodato" >
                    <option value = "Regular">Regular</option>
                    <option value = "Honors">Honors</option>
                </select>  <span class ="error" name="err">*</span>
                
                <br><br>
                <button id = "saveNewRecord" class = 'option' >Guardar</button>

             </fieldset>
             <br>
             <br>


        </div>

        <br>

        <!-- ../../Servidor/controllers/index.php -->
        <form action ="index.php" method = "post">

            <select id = "tiporeporte" name = "tiporeporte" >
                <option value = "enlugarfecha">En base a lugar y fecha</option>
                <option value = "enmateria">En base a materia</option>
            </select>


            <select id = "diaDropDown" name = "dia" >
                <option value = "Lunes">Lunes</option>
                <option value = "Martes">Martes</option>
                <option value = "Miercoles">Miercoles</option>
                <option value = "Jueves">Jueves</option>
                <option value = "Viernes">Viernes</option>
            </select>

            <select id = "salonDropDown" name = "salon">
                <?php for($i= 0; $i < count($allClassrooms); $i++) { ?> 
                             
                    <option value=   '<?php echo $allClassrooms[$i]["numero"] ; ?>'  >      <?php echo $allClassrooms[$i]["numero"] ; ?>       </option>
                
                <?php } ?> 
            </select>

            <select id= "claveMateriaDropDown" name = "clavemateria" hidden>
                <?php for($i= 0; $i < count($allTopics); $i++) { ?> 
                             
                    <option value=   '<?php echo $allTopics[$i]["clave"] ; ?>'   >      <?php echo $allTopics[$i]["nombre"] ; ?>       </option>
                
                <?php } ?> 
            </select>


            <input type ="submit" name = "type" class = "option" value = "Reporte" >
            <input type = "text" name = "action" value = "Cursos" hidden>
            <br>
            <br>

        </form>

        <br>
        <br>
        

    </body>
</html>