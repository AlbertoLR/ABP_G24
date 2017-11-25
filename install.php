<form action="install.php" method="POST">
    <p>Mysql Root User: <input type="text" name="user" /></p>
    <p>Mysql Root Password:  <input type="password" name="passwd" /></p>
    <p><input type="submit" name="submit" value="submit" /></p>
</form>

<?php
if (isset($_POST["submit"])){
    $mysqlUserName = $_POST["user"];
    $mysqlPasswd = $_POST["passwd"];
    $dbFile = "ABP.sql";
    $command='mysql -u' .$mysqlUserName .' -p' .$mysqlPasswd . ' < ' .$dbFile;
    exec($command,$output=array(),$worked);
    switch($worked){
	case 0:
            echo 'El archivo <b>' .$dbFile .'</b> ha sido importado a la base de datos correctamente<br />';
            echo 'Usuario de base de datos creado: root con contraseña iu<br />';
            echo '<a href="index.php">Continuar a la web</a><br />';
            break;
	case 1:
            echo 'Hubo un error durante la importacion: El usuario ya existe o se han usado credenciales erroneas<br /><br />';
            echo 'Usuario de base de datos creado: root con contraseña iu<br /><br />';
            echo '<a href="index.php">Comprobar si las credenciales son correctas y continuar a la web</a>';
            break;
    }
}
?>