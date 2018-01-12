<?php
/**
 * Description of VCargarVerSesion
 *
 * @author iago
 */

class VCargarVerSesion {
    function __construct() {
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
                            Ver sesiones <small>Elija su opción</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<?php
	if ($_SESSION['Id_PerfilUsuario']==2){
?>
             <div class="row">
             <div class="col-lg-3 col-md-6">
                 <a href="../controller/CSesion.php?action=verSesion&tipo=normales">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img class="imagenes" src="../images/granGrupo.png">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left">Usuarios normales</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
		</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CSesion.php?action=verSesion&tipo=pef">
				<div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/grupo.png">
                                    </div> 
                                </div>
                            </div>							                        
                                <div class="panel-footer">
                                    <span class="pull-left">Tus usuarios PEF</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div> 
                            </div>
			</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CSesion.php?action=principal">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <img class="imagenes" src="../images/return.png">
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <span class="pull-left">Volver</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
			</a>
                    </div>
<?php
        }
?> 
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
?>