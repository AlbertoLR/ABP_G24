<?php
/**
 * Description of VPrincipalEjercicio
 *
 * @author iago
 */

include "../layout/menus.php";
include "../layout/footer.php";

class VPrincipalEjercicio {
    function vistaEntrenador(){
        include_once "../layout/menus.php";
        include_once "../layout/footer.php";

        menus();
?>
        <div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Ejercicios <small>Elija su opción</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<?php
	if ($_SESSION['Id_PerfilUsuario']==2){
?>
             <div class="row">
             <div class="col-lg-3 col-md-6">
                <a href="../controller/CEjercicio.php?action=alta">
			<div class="panel panel-primary">
                            <div class="panel-heading">
                               <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/add.png">
                                    </div>
                                </div>
                            </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Añadir ejercicio</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
			</div>
		</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CEjercicio.php?action=consulta">
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
                        <a href="../controller/CEjercicio.php?action=verEjercicio">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/ejercicio.png">
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-footer">
                                    <span class="pull-left">Ver ejercicios</span>
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