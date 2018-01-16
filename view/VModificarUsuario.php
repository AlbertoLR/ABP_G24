<?php
/**
 * Vista que muestra un formulario para seleccionar el Usuario a modificar para luego mostrar el formulario a modificar
 *
 * @author Samu
 */
include_once "../layout/menus.php";
include_once "../layout/footer.php";

class VModificarUsuario{
    function __construct($listaUsuarios) {
        $this->render($listaUsuarios);
    }
    
    function render($listaUsuarios){
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
                <form action="../controller/CUsuario.php" method="post">
                    <div>
                        <p>Selecione la ID del Usuario a modificar:</p>
<?php
        $tupla=$listaUsuarios->fetch_row();
        do{
            echo "<input type='radio' name='Id_usuario' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaUsuarios->fetch_row();
        }while(!is_null($tupla));
?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                    </div>
                </form>
         

<?php
footer();
    }
    
    static function mostrarFormulario($Id_usuario){
        menus();
?>
        
                <h2>Formulario de modificacion del Usuario:</h2>
                <form action="../controller/CUsuario.php" method="post">
<?php
        echo "<input type='hidden' name='Id_usuario' value='$Id_usuario'/>";
?>
                    <div>
                        <label for="nombreUs">Nombre :</label>
                        <input type="text" name="nombreUs" size="45"/>
                    </div>
                    <div>
                        <label for="Apellido">Apellidos:</label><br>
                       <input type="text" name="Apellido" size="45"/>
                    </div>
                    <div>
                        <label for="DNIUs">Dni:</label><br>
                       <input type="text" name="DNIUs" size="9"/>
                    </div>
                       <div>
                        <label for="Telefono">Telefono:</label><br>
                       <input type="number" name="Telefono" size="9"/>
                    </div>
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
           
<?php
footer();
    }
}
?>
