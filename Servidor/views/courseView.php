<!DOCTYPE html>
<html lang="es">
    <head>

        <!--<link rel="stylesheet" type="text/css" href="./css/login.css">-->
        <style>
            <?php include '../views/css/general.css'; ?>
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
        <table align = "center">
             <tr>
                 <th>Materia</th>
                 <th>Grupo</th>
                 <th>Horario</th>
                 <th>Laboratorio</th>
                 <th>Salon</th>
                 <th>Profesor</th>
                 <th>Correo</th>
             </tr>
            <?php for($i= 0; $i < count($allCourses); $i++) { ?> 
            <tr>
                <td> <?php echo $allCourses[$i]["materia"] ; ?> </td>
                <td> <?php echo $allCourses[$i]["grupo"] ; ?> </td>
                <td> <?php echo $allCourses[$i]["horario"] ; ?> </td>
                <td> <?php echo $allCourses[$i]["horaslaboratorio"] ; ?> </td>
                <td> <?php echo $allCourses[$i]["salon"] ; ?> </td>
                <td> <?php echo $allCourses[$i]["nombre"] ; ?> </td>
                <td> <?php echo $allCourses[$i]["correo"] ; ?> </td>
            </tr> 
            <?php } ?> 
        </table>

        <br>

        <br>
        <br>

        <!-- ../../Servidor/controllers/index.php -->
        <form action ="index.php" method = "post">
            <input type ="submit" name = "type" class = "btn" value = "Reporte" >
            <input type = "text" name = "action" value = "Cursos" hidden>
        </form>
        

    </body>
</html>