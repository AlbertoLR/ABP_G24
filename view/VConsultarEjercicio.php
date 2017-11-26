<?php
/**
 * Vista que muestra un formulario para buscar ejercicios, para mostrarlos en una tabla
 *
 * @author iago
 */

class VConsultarEjercicio{
    function __construct() {
        $this->render();
    }
    
    function render(){
?>
        <html>
            <head>
                <title>Ver ejercicios</title>
            </head>
            <body>
                <h2>Tipos de Ejercicios:</h2>
                <p><a href="../controller/CEjercicio.php?action=consulta&tipoEj=aerobico">Ejercicios Aerobicos</a></p>
                <p><a href="../controller/CEjercicio.php?action=consulta&tipoEj=anaerobico">Ejercicios Anaerobicos</a></p>
                <p><a href="../controller/CEjercicio.php?action=consulta&tipoEj=mixto">Ejercicios Mixtos</a></p>
            </body>
	</html>
<?php
    }
    
    static function mostrar($resultado){
        $tupla=$resultado->fetch_row();
?>
        <html>
            <head>
                <title>Ver ejercicios</title>
            </head>
            <body>
<?php
        echo "<h2>Ejercicios $tupla[3]:</h2>";

        do{
            echo "<p><a href='../controller/CEjercicio.php?action=verDetalle&idEjercicio=$tupla[0]'>$tupla[1]</a></p>";
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