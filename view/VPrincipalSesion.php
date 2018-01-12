<?php
/**
 * Description of VPrincipalSesion
 *
 * @author iago
 */

include_once "../layout/menus.php";
include_once "../layout/footer.php";

class VPrincipalSesion {
    function vistaUser(){
        menus();
?>
        <div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Sesion <small>Elija su opción</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<?php
	if ($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4){
?>
             <div class="row">
             <div class="col-lg-3 col-md-6">
                 <a href="../controller/CSesion.php?action=cargarAlta">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img class="imagenes" src="../images/add.png">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left">Iniciar sesion</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
		</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CSesion.php?action=consulta">
				<div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/search.png">
                                    </div> 
                                </div>
                            </div>							                        
                                <div class="panel-footer">
                                    <span class="pull-left">Buscar</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div> 
                            </div>
			</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CSesion.php?action=verSesion">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <img class="imagenes" src="../images/sesion.png">
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <span class="pull-left">Ver sesiones</span>
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
    
    function vistaEntrenador(){
        menus();
?>
        <div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Sesion <small>Elija su opción</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<?php
	if ($_SESSION['Id_PerfilUsuario']==2){
?>
             <div class="row">
             <div class="col-lg-3 col-md-6">
                 <a href="../controller/CSesion.php?action=cargarVerSesion">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <img class="imagenes" src="../images/sesion.png">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <span class="pull-left">Ver sesiones</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
		</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CSesion.php?action=consulta">
				<div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/search.png">
                                    </div> 
                                </div>
                            </div>							                        
                                <div class="panel-footer">
                                    <span class="pull-left">Buscar</span>
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
