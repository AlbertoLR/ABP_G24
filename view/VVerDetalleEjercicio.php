<?php
/**
 * Vista que muestra en detalle un ejercicio
 *
 * @author iago
 */
class VVerDetalleEjercicio {
    function __construct($ejercicio) {
        $this->render($ejercicio);
    }
    
    function render($ejercicio){
?>
        <html>
            <head>
                <title>Ver ejercicio</title>
            </head>
            <body>
<?php
        echo "<h2>Ejercicio $ejercicio[1]:</h2>";
        echo "<p>Tipo de ejercicio: $ejercicio[3]</p>";
        echo "<p>Descripcion:<br>$ejercicio[2]</p>";
?>
            </body>
	</html>
<?php
    }
}
?>