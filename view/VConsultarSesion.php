<?php
/**
 * Vista que muestra un formulario para buscar sesiones, para mostrarlas en una tabla
 *
 * @author iago
 */

class VConsultarSesion{
    function vistaUser($tablas){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Buscar Sesion <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CSesion.php" method="post">
                    <div class="apartado">
                        <label for="nombreSesion">Nombre:</label>
                        <input type="text" name="nombreSesion" size="45"/>
                    </div>
                    <div class="apartado">
			<label for="idTabla">Tabla de la sesion:</label><br>
<?php
        $tupla=$tablas->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='radio' name='idTabla' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?> </b><br>
<?php
                $tupla=$tablas->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="consulta"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CSesion.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
    
    function vistaEntrenador(){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Buscar Sesion <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CSesion.php" method="post">
                    <div class="apartado">
                        <label for="nombreSesion">Nombre sesion:</label>
                        <input type="text" name="nombreSesion" size="45"/>
                    </div>
                    <div class="apartado">
                        <label for="nombreTabla">Nombre tabla:</label>
                        <input type="text" name="nombreTabla" size="45"/>
                    </div>
                    <div class="apartado">
                        <label for="DNI">DNI del usuario:</label>
                        <input type="text" name="DNI" size="45"/>
                    </div>
                    <div class="apartado">
                        <label for="horaInicio">Fecha de la sesion:</label>
                        <input type="text" name="horaInicio" size="45"/>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="consulta"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CSesion.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
}
?>