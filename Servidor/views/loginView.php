<!DOCTYPE html>
<html lang="es">

    <head>

        <style>
            <?php include '../views/css/general.css'; ?>
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                <meta charset="UTF-8" />

        <title>Universidad Random | Sistema de inscripciones</title>    
    </head>


    <body>
    	
        <div id="headerDiv">
        	
          	<img src="../views/img/estrella2.png" height="50" width="50">
        	<span>
                Universidad Random
            </span>
            <br>
            <span class="slogan">
                Sistema de inscripciones
            </span>
            
        </div>
        

        <br>
        <br>
        <br>
        <br>
         
         <!-- ../../Servidor/controllers/index.php -->
        <form action ="index.php" method = "post">
            <span>
            <fieldset id="LogIn" class="right">
            	
                <legend>Iniciar sesión en el sistema </legend>
                
                <p>Correo electrónico</p>


                <input type="text" name = "correo">

                <br>
                <br>
                <p>Contraseña</p>
                <input type="password" name = "contrasena">

                <!--
                <input type ="text" name = "action" value = "login" hidden>
                -->
                 

                <span id="LogInErr" class ="error2">¡Tu correo y/o contraseña son incorrectos! </span>


                <br>
                <br>
                 
                <input type="submit" name = "action" class="btn" value="Ingresar">
                <input type="checkbox" name="gender" value="0">
                <span class="spanFormat2">Recuérdame</span>
                <br>

                <!--
                <br>
                <input type ="submit" name = "action" class = "btn" value = "Reporte" >
                <br>
                -->


                <!-- 
                <a href="../../Servidor/controllers/downloadService.php">Descargar doc(PDF)</a>
                -->

                <!--
                <br>
                <input type ="submit" value = "Ingresar con FORM" >
                <br>
                -->
            </fieldset>
            </span>  

        </form> 

        <br>
        <br>

        <!--
        <form action ="../../Servidor/controllers/index.php" method = "post">
            <input type ="submit" class = "btn" value = "Generar reporte" >
            <input type = "text" name = "action" value = "report" hidden>
        </form>
        -->

        <!--
        <script>
            <?php //include 'js/login.js'; ?>
        </script>
         -->
        
    </body>
</html>