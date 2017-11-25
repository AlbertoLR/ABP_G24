<!DOCTYPE html>
<!--
  Vista que muestra el index de la aplicacion
 
  @author iago
-->
<?php
session_start();
include "core/Login.php";
estaRegistrado();
?>

<html>
    <head></head>
    <body>
        <h1>Index de prueba:</h1>
        <h2>Gestion de ejercicio</h2>
        <form action="controller/CEjercicio.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
        <br><br>
        <h2>Gestion de sesion</h2>
        <form action="controller/CSesion.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
		<br><br>
        <h2>Gestion de controlador</h2>
        <form action="controller/CControlador.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
		<br><br>
        <h2>Gestion de acción</h2>
        <form action="controller/CAccion.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
		<br><br>
        <h2>Gestion de actividad</h2>
        <form action="controller/CActividad2.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
		<br><br>
        <h2>Gestion de usuario</h2>
        <form action="controller/CUsuario.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
		<br><br>
        <h2>Gestion de perfil de usuario</h2>
        <form action="controller/CPerfilUsuario.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
		<br><br>
        <h2>Gestion de tabla</h2>
        <form action="controller/CTabla.php" method="post">
            <div>
                <p>Accion a realizar:</p>
                <select name="action">
                    <option>alta</option>
                    <option>baja</option>
                    <option>modificacion</option>
                    <option>consulta</option>
					<option>asignarEj</option>
					<option>asignarUser</option>
					<option>verDetalle</option>
                </select>
            </div>
            <button type="submit" name="submit" value="Enviar">Enviar</button>
        </form>
    </body>
</html>
