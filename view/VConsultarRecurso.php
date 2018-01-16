<?php
/**
 * Vista que muestra un formulario para buscar Recursos, para mostrarlos en una tabla
 *
 * @author Samu
 */

class VConsultarRecurso{
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
                            Consultar recurso <small>Elige el recurso 
                            </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <h2>Formulario de busqueda:</h2>
                <form action="../controller/CRecurso.php" method="post">
                    <div>
                        <label for="Nombre">Nombre recurso: </label>
                        <input type="text" name="Nombre" size="9"/>

                    </div>
                    <div>
                        <button type="submit" name="action" value="consulta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
        
<?php
footer();
    }
    
    static function mostrar($resultado){
        menus();
?>
        
                <h2>Formulario de busqueda:</h2>
                <table class="table">
                    <tr>
                        <th>Nombre Recurso</th>
                        <th>Capacidad</th>
                    </tr>
<?php
        $tupla=$resultado->fetch_row();
        do{
            echo "<tr><td>$tupla[1]</td>";
            echo "<td>$tupla[2]</td></tr>";
            $tupla=$resultado->fetch_row();
        }while(!is_null($tupla));
?>
                </table>
      <div class="row">
                    <div class="col-lg-12">
                        <a href="../controller/CRecurso.php?action=principal">
                            <img class="imagenes" src="../images/return.png" width="4%">
                        </a>
                    </div>
           
<?php
footer();
    }
}
?>