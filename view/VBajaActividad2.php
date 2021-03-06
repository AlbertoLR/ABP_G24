<?php
/**
 * Vista que muestra un formulario para seleccionar el Actividad a borrar para luego mostrar el Actividad seleccionado y solicitar confirmacion
 *
 * @author Samu
 */
include "../layout/menus.php";
include "../layout/footer.php";

class VBajaActividad2{
    function __construct($listaActividad) {
        $this->render($listaActividad);
    }
      function render($listaActividad){
?>
<?php
    menus();
?>
        <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Borrar Actividad <small>Seleccione la actividad a borrar</small>
                        </h1>
                    </div>
                </div>
                <form action="../controller/CActividad2.php" method="post">
                    <div>
                        <p>Selecione la ID del Actividad a borrar:</p>
<?php
        $tupla=$listaActividad->fetch_row();
        do{
            echo "<input type='radio' name='Id_Actividad' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaActividad->fetch_row();
        }while(!is_null($tupla));
?>
                    </div>
                    <div>
                        <button type="submit" name="action" value="baja">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
footer();
    }
    
    static function solicitarConfirmacion($ActividadBorrar){
        menus();
?>
       
                  <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
              Borrar Actividad <small>¿Desea borrar esta actividad?</small>
                        </h1>
                <table class="table">
                    <tr>
                        <td>Id del Actividad:</td>
<?php                                                      
        echo "<td>$ActividadBorrar[0]</td>";
?>
                    </tr>
                    <tr>
                        <td>Nombre del Actividad:</td>
<?php
        echo "<td>$ActividadBorrar[1]</td>";
?>
                    </tr>
                    <tr>
                        <td>Descripcion del Actividad:</td>
<?php
        echo "<td>$ActividadBorrar[2]</td>";
?>
                    </tr>
                </table>
                <br><br>
                <form action="../controller/CActividad2.php" method="POST">
<?php
        echo "<input type='hidden' name='Id_Actividad' value='$ActividadBorrar[0]'/>";
        echo "<input type='hidden' name='nombreAc' value='$ActividadBorrar[1]'/>";
        echo "<input type='hidden' name='sala' value='$ActividadBorrar[2]'/>";
        echo "<input type='hidden' name='Capacidad' value='$ActividadBorrar[3]'/>";
        echo "<input type='hidden' name='HoraInicio' value='$ActividadBorrar[4]'/>";
        echo "<input type='hidden' name='HoraFin' value='$ActividadBorrar[5]'/>";
        echo "<input type='hidden' name='Dia' value='$ActividadBorrar[5]'/>";



    
      
        echo "<input type='hidden' name='action' value='baja'/>";
?>
                    <div><center>
                        <button type="submit" name="confirmar" value="si">Si</button>
                        <button type="submit" name="confirmar" value="no">No</button>
                    </center>
                    </div>
                </form>
            </body>
        </html>
<?php
footer();
    }
}
?>
