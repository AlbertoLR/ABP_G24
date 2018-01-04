<?php
/**
 * Description of VAsignarUsuario
 *
 * @author iago
 */

class VAsignarUsuario {
    function __construct($tablas,$usuariosPropios,$usuariosNormales) {
        $this->render($tablas,$usuariosPropios,$usuariosNormales);
    }
    
    function render($tablas,$usuariosPropios,$usuariosNormales){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Asignar Tabla <small>Seleccione usuarios y tabla predeterminada</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CTabla.php" method="post">
                    <div class="apartado">
			<label for="idTabla">Tabla por asignar:</label><br>
<?php
        $tupla=$tablas->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='radio' name='idTabla' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?><br>
<?php
                $tupla=$tablas->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
			<label for="usuarios">Usuarios a asignar:</label><br>
<?php
        $tupla=$usuariosPropios->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='checkbox' name='usuarios[]' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?><br>
<?php
                $tupla=$usuariosPropios->fetch_row();
            }
            while(!is_null($tupla));
        }
        $tupla=$usuariosNormales->fetch_row();
        if($tupla!=null){
            do{
?>
                        <input type='checkbox' name='usuarios[]' value='<?=$tupla[0]?>'><b> <?=$tupla[1]?><br>
<?php
                $tupla=$usuariosNormales->fetch_row();
            }
            while(!is_null($tupla));
        }
?>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="asignarUser"><b>Enviar</b></button>
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