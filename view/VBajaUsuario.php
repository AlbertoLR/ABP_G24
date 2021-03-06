<?php
/**
 * Vista que muestra un formulario para seleccionar el Usuario a borrar para luego mostrar el Usuario seleccionado y solicitar confirmacion
 *
 * @author Samu
 */

class VBajaUsuario{
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
                            Borrar Usuario <small>Elige Usuario</small>
                        </h1>
                    </div>
                </div>
                <h2>Seleccione el Usuario a borrar:</h2>
                <form action="../controller/CUsuario.php" method="post">
                    <div>
                        <p>Selecione la ID del Usuario a borrar:</p>
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
                        <button type="submit" name="action" value="baja">Enviar</button>
                    </div>
                </form>
          
<?php
footer();
    }
    
    static function solicitarConfirmacion($UsuarioBorrar){
        menus();
?>
        
                <h2>¿Desea borrar este Usuario?</h2>
                <table class="table">
                    <tr>
                        <td>DNI Usuario:</td>
<?php
        echo "<td>$UsuarioBorrar[3]</td>";
?>
                    </tr>
                    <tr>
                        <td>Nombre del Usuario:</td>
<?php
        echo "<td>$UsuarioBorrar[1]</td>";
?>
                    </tr>
                    <tr>
                        <td>Apellido del Usuario:</td>
<?php
        echo "<td>$UsuarioBorrar[2]</td>";
?>
                    </tr>
                </table>
                <br><br>
                <form action="../controller/CUsuario.php" method="POST">
<?php
        echo "<input type='hidden' name='Id_usuario' value='$UsuarioBorrar[0]'/>";
        

        echo "<input type='hidden' name='action' value='baja'/>";
?>
                    <div><center>
                        <button type="submit" name="confirmar" value="si">Si</button>
                        <button type="submit" name="confirmar" value="no">No</button>
                        </center>
                    </div>
                </form>
          
<?php
footer();
    }
}
?>
