<?php
/**
 * Vista que muestra un formulario para buscar una tabla para mostrarla en detalle
 *
 * @author iago
 */
class VVerDetalleTabla {
    function __construct($tabla,$ejercicios,$usuarios) {
        $this->render($tabla,$ejercicios,$usuarios);
    }
    
    function render($tabla,$ejercicios,$usuarios){
?>
        <html>
            <head></head>
            <body>
<?php
        echo "<h2>Tabla $tabla[1]:</h2>";
        echo "<p>Tipo de tabla: $tabla[2]</p>";
?>
                <p>Ejercicios de la tabla:</p>
                <table>
                    <tr>
                        <td>Id ejercicio</td>
                        <td>Nombre ejercicio</td>
                        <td>Num repeticiones</td>
                    </tr>
<?php
        $tupla=$ejercicios->fetch_row();
        do{
            echo "<tr><td>$tupla[0]</td>";
            echo "<td>$tupla[1]</td>";
            echo "<td>$tupla[2]</td></tr>";
            $tupla=$ejercicios->fetch_row();
        }while(!is_null($tupla));
?>
                </table>
<?php
        $string="<p>Usuarios con esta tabla asignada: ";
        $tupla=$usuarios->fetch_row();
        do{
            $string.="$tupla[1]";
            $tupla=$usuarios->fetch_row();
            if(!is_null($tupla)){
                $string.=", ";
            }
        }while(!is_null($tupla));
        $string.=".</p>";
        echo "$string";
?>
            </body>
        </html>
<?php
    }
}
?>