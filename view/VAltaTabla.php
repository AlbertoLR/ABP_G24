<?php
/**
 * Vista que muestra un formulario para dar de alta una tabla
 *
 * @author iago
 */

class VAltaTabla {
    function __construct($idUser) {
        $this->render($idUser);
    }
    
    function render($idUser){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nueva Tabla <small> Introduzca el nombre de la nueva tabla</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CTabla.php" method="post">
<?php
        if(!is_null($idUser)){
?>
                    <input type='hidden' name='Id_usuario' value='<?=$idUser?>'/>
                    <input type='hidden' name='tipoTabla' value='Personalizada'/>
<?php
        }
        else{
?>
                    <input type='hidden' name='tipoTabla' value='Predeterminada'/>
<?php
        }
?>
                    <div class="apartado">
                        <label for="nombreTabla">Nombre de la Tabla:</label>
                        <input type="text" name="nombreTabla" size="45"/>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="alta"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CTabla.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
}
?>