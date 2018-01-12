<?php
/**
 * Vista que muestra un formulario para seleccionar la sesion a modificar para luego mostrar el formulario a modificar
 *
 * @author iago
 */

class VModificarSesion {
    function __construct($idSesion,$tablas){
        $this->render($idSesion,$tablas);
    }
    
    function render($idSesion,$tablas){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Editar sesion <small>Introduzca datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CSesion.php" method="post">
                    <input type='hidden' name='idSesion' value='<?=$idSesion?>'/>
                    <div class="apartado">
                        <label for="nombreSesion">Nombre:</label>
                        <input type="text" name="nombreSesion" size="45"/>
                    </div>
                    <div class="apartado">
			<label for="idTabla">Tabla:</label><br>
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
                        <label for="comentario">Comentario:</label>
                        <input type="text" name="comentario" size="45"/>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="modificacion"><b>Enviar</b></button>
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
