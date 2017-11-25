<?php
/**
 * Vista que muestra un formulario para buscar Actividad2s, para mostrarlos en una tabla
 *
 * @author Samu
 */

class VConsultarActividad2{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de busqueda:</h2>
                <form action="../controler/CActividad2.php" method="post">
                    <div>
                        <label for="sala">DNI: </label>
                        <input type="text" name="sala" size="9"/>

                    </div>
                    <div>
                        <button type="submit" name="action" value="consulta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
    
    static function mostrar($resultado){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de busqueda:</h2>
                <table>
                    <tr>
                        <td>Nombre Actividad</td>
                        <td>sala</td>
                        <td>Capadidad</td>
                          <td>Hora inicio</td>
                        <td>Hora Fin</td>
                          <td>Dia</td>
                   
                    </tr>
<?php
        $tupla=$resultado->fetch_row();
        do{
            echo "<tr><td>$tupla[1]</td>";
            echo "<td>$tupla[2]</td>";
             echo "<td>$tupla[3]</td>";
            echo "<td>$tupla[4]</td>";
             echo "<td>$tupla[5]</td>";
              echo "<td>$tupla[6]</td>";
            

            $tupla=$resultado->fetch_row();
        }while(!is_null($tupla));
?>
                </table>
            </body>
        </html>
<?php
    }
}
?>