<?php
/**
 * Vista que muestra un formulario para seleccionar el Recurso a modificar para luego mostrar el formulario a modificar
 *
 * @author Samu
 */
include_once "../layout/menus.php";
include_once "../layout/footer.php";

class VModificarRecurso{
    function __construct($listaRecursos) {
        $this->render($listaRecursos);
    }
    
    function render($listaRecursos){
        menus();
?>
       <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Modificar Recurso <small>Elija su opción</small>
                        </h1>
                    </div>
                </div>
                <form action="../controller/CRecurso.php" method="post">
                    <div>
                        <p>Selecione la ID del Recurso a modificar:</p>
<?php
        $tupla=$listaRecursos->fetch_row();
        do{
            echo "<input type='radio' name='Id_Recurso' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaRecursos->fetch_row();
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
    
    static function mostrarFormulario($Id_Recurso){
        menus();
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de modificacion del Recurso:</h2>
                <form action="../controller/CRecurso.php" method="post">
<?php
        echo "<input type='hidden' name='Id_Recurso' value='$Id_Recurso'/>";
?>
                    <div>
                        <label for="Nombre">Nombre del Recurso:</label>
                        <input type="text" name="Nombre" size="30"/>
                    </div>
                    <div>
                        <label for="Capacidad">Capacidad:</label><br>
                       <input type="text" name="Capacidad" size="9"/>
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
