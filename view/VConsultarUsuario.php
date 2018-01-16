<?php
/**
 * Vista que muestra un formulario para buscar Usuarios, para mostrarlos en una tabla
 *
 * @author Samu
 */

class VConsultarUsuario{
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
                           Buscar Usuario <small>Introduzca los datos</small>
                        </h1>
                    </div>
                </div>
                <h2>Formulario de busqueda:</h2>
                <form action="../controller/CUsuario.php" method="post">
                    <div>
                        <label for="DNIUs">DNI: </label>
                        <input type="text" name="DNIUs" size="9"/>

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
                        <th>Nombre Usuario</th>
                        <th>Apellido</th>
                        <th>DNI Usuario</th>
                        <th>Telefono</th>
                    </tr>
<?php
        $tupla=$resultado->fetch_row();
        do{
            echo "<tr><td>$tupla[1]</td>";
            echo "<td>$tupla[2]</td>";
            echo "<td>$tupla[3]</td>";
            echo "<td>$tupla[4]</td></tr>";
            $tupla=$resultado->fetch_row();
        }while(!is_null($tupla));
?>
                </table>
           
<?php
footer();
    }
}
?>