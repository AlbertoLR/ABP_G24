<?php
/**
 * Vista que muestra un formulario para seleccionar el Recurso a borrar para luego mostrar el Recurso seleccionado y solicitar confirmacion
 *
 * @author Samu
 */

class VBajaRecurso{
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
                            Eliminar Recurso <small>Elige el recurso
                            </small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <form action="../controller/CRecurso.php" method="post">
                    <div>
                        <p>Selecione la ID del Recurso a borrar:</p>
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
                        <button type="submit" name="action" value="baja">Enviar</button>
                    </div>
                </form>
            

<?php
footer();
    }
    
    static function solicitarConfirmacion($RecursoBorrar){
        menus();
?>
        <html>
            <head></head>
            <body>
                <h2>¿Desea borrar este Recurso?</h2>
                <table>
                    <tr>
                        <td>Id del Recurso:</td>
<?php
        echo "<td>$RecursoBorrar[0]</td>";
?>
                    </tr>
                    <tr>
                        <td>Nombre del Recurso:</td>
<?php
        echo "<td>$RecursoBorrar[1]</td>";
?>
                    </tr>
                    <tr>
                        <td>Capacidad Sala/Pista:</td>
<?php
        echo "<td>$RecursoBorrar[2]</td>";
?>
                    </tr>
                </table>
                <br><br>
                <form action="../controller/CRecurso.php" method="POST">
<?php
        echo "<input type='hidden' name='Id_Recurso' value='$RecursoBorrar[0]'/>";
        echo "<input type='hidden' name='Nombre' value='$RecursoBorrar[1]'/>";
        echo "<input type='hidden' name='Capacidad' value='$RecursoBorrar[2]'/>";
        echo "<input type='hidden' name='action' value='baja'/>";
?>
                    <div>
                        <button type="submit" name="confirmar" value="si">Si</button>
                        <button type="submit" name="confirmar" value="no">No</button>
                    </div>
                </form>
            </body>
        </html>
<?php
footer();
    }
}
?>
