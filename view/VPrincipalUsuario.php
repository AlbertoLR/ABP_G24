<?php
/**
 * Description of VPrincipalUsuario
 *
 * @author iago
 */

include_once "../layout/menus.php";
include_once "../layout/footer.php";

class VPrincipalUsuario {
    function vistaAdministrador(){
        menus();
?>
        <div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Usuario <small>Elija su opción</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<?php
	if ($_SESSION['Id_PerfilUsuario']==1){
?>
             <div class="row">
             <div class="col-lg-3 col-md-6">
                 <a href="../controller/CUsuario.php?action=alta">
			<div class="panel panel-primary">
                            <div class="panel-heading">
                               <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/add.png">
                                    </div>
                                </div>
                            </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Añadir usuario</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
			</div>
		</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="../controller/CUsuario.php?action=consulta">
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
                        <a href="../controller/CUsuario.php?action=modificacion">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/edit.png">
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-footer">
                                    <span class="pull-left">Modificar usuario</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                        </div>
					</a>
                    </div>
                 <div class="col-lg-3 col-md-6">
                    <a href="../controller/CUsuario.php?action=baja">
				<div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img class="imagenes" src="../images/delete.png">
                                    </div> 
                                </div>
                            </div>							                        
                                <div class="panel-footer">
                                    <span class="pull-left">Borrar usuario</span>
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
