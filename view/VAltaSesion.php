<?php
/**
 * Vista que muestra un formulario para dar de alta una sesion
 *
 * @author iago
 */

class VAltaSesion {
    function __construct($idTabla,$horaInicio,$duracion){
        $this->render($idTabla,$horaInicio,$duracion);
    }
    
    function render($idTabla,$horaInicio,$duracion){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Finalizar sesion <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table">
                    <tr>
                        <td>Nombre sesion (por defecto):</td>
                        <td><?=$idTabla."--".$horaInicio?></td>
                    </tr>
                    <tr>
                        <td>Hora de inicio:</td>
                        <td><?=$horaInicio?></td>
                    </tr>
                    <tr>
                        <td>Duracion:</td>
                        <td><?=$duracion?></td>
                    </tr>
                </table>
        
                <form action="../controller/CSesion.php" method="post">
                    <input type='hidden' name='idTabla' value='<?=$idTabla?>'/>
                    <input type='hidden' name='horaInicio' value='<?=$horaInicio?>'/>
                    <input type='hidden' name='duracion' value='<?=$duracion?>'/>
                    
                    <div class="apartado">
                        <label for="nombreSesion">Nombre:</label>
                        <input type="text" name="nombreSesion" size="45"/>
                    </div>
                    <div class="apartado">
                        <label for="comentario">Comentario:</label>
                        <input type="text" name="comentario" size="45"/>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="alta"><b>Enviar</b></button>
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