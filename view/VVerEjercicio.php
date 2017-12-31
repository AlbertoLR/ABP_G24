<?php
/**
 * Description of VVerEjercicio
 *
 * @author iago
 */

class VVerEjercicio {
    function __construct() {
        $this->render();
    }
    
    function render(){
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
                <a href="../controller/CEjercicio.php?action=showAll&tipoEj=aerobico">
			<div class="panel panel-primary">
                            <div class="panel-heading">
                               <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/aerobico.png">
                                    </div>
                                </div>
                            </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Ejercicios aerobicos</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
			</div>
		</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CEjercicio.php?action=showAll&tipoEj=anaerobico">
				<div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/anaerobico.png">
                                    </div> 
                                </div>
                            </div>							                        
                                <div class="panel-footer">
                                    <span class="pull-left">Ejercicios anaerobicos</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div> 
				</div>
						</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CEjercicio.php?action=showAll&tipoEj=mixto">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/mixto.png">
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-footer">
                                    <span class="pull-left">Ejercicios mixtos</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                        </div>
					</a>
                    </div>
                 <div class="col-lg-3 col-md-6">
                <a href="../controller/CEjercicio.php?action=principal">
			<div class="panel panel-primary">
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
