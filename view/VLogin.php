<?php
/**
 * Vista que muestra un formulario para iniciar sesion
 *
 * @author iago
 */

include_once "../layout/menus.php";
include_once "../layout/footer.php";

class VLogin {
    function __construct(){
        $this->render();
    }
    
    function render(){
        menus();
?>
        <div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Login <small>Iniciar sesion</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="../controller/CLogin.php" method="post">
                    <div class="apartado">
                        <label for="dni">Usuario:</label>
                        <input type="text" name="dni" size="20"/>
                    </div>
                    <div class="apartado">
                        <label for="password">Password:</label>
                        <input type="password" name="password" size="20"/>
                    </div>
                    <div class="apartado">
                        <button type="submit" name="action" value="comprobar">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
                
            </div>
            <!-- /.container-fluid -->
		
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
	footer();
    }
}

