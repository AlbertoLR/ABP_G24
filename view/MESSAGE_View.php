<?php
/**
 * Vista que muestra un mensaje referente a una accion realizada
 *
 * @author iago
 */

include_once "../layout/menus.php";
include_once "../layout/footer.php";
 
 class MESSAGE_View {
    function __construct($mensaje,$volver){
        $this->render($mensaje,$volver);
    }
    
    function render($mensaje,$volver){
        menus();
?>
	<div id="page-wrapper">
		
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Aviso
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
        
                <table class="table"><tr><td><br><br><br><center><?=$mensaje?></center><br><br><br></td></tr></table>
                
                <div class="row">
                    <div class="col-lg-12">
                        <a href='<?=$volver?>'>
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
                </div>
           
<?php
	footer();
    }
}
?>
