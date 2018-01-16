<?php
/**
 * Vista que muestra un formulario para dar de alta un Usuario
 *
 * @author Samu
 */
include "../layout/menus.php";
include "../layout/footer.php";
 
 
class VAltaUsuario{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
<?php
	menus();
?>
		<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nuevo Usuario <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <form action="../controller/CUsuario.php" method="post">
                    <div class="apartado">
                        <label for="nombreUs">Nombre del Usuario:</label>
                        <input type="text" name="nombreUs" size="30"/>
                    </div>
					<div class="apartado">
                        <label for="Apellido">Apellidos del Usuario:</label>
                        <input type="text" name="Apellido" size="30"/>
                    </div>
                    <div class="apartado">
                        <label for="DNIUs">DNI del usuario:</label>
                        <input type="text" name="DNIUs" size="9"/>
                    </div>
					<div class="apartado">
                        <label for="Telefono">Teléfono:</label>
                        <input type="text" name="Telefono" size="12"/>
                    </div>
					<div class="apartado">
					 <label for="Id_PerfilUsuario">Perfil de Usuario:</label><br>	
                     <input type='radio' name='Id_PerfilUsuario' value='1'><b> Administrador </b><br>
                     <input type='radio' name='Id_PerfilUsuario' value='2'><b> Entrenador </b><br>
                     <input type='radio' name='Id_PerfilUsuario' value='3'><b> Usuario PEF </b><br>
                     <input type='radio' name='Id_PerfilUsuario' value='4'><b> Usuario TDU </b><br>  
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="alta"><b>Enviar</b></button>
                        <button type="reset" name="reset" value="Borrar"><b>Borrar</b></button>
                    </div>
                </form>
           
<?php
	footer();
    }
	
}
?>