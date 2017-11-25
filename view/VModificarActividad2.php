<?php
/**
 * Vista que muestra un formulario para seleccionar el Actividad a modificar para luego mostrar el formulario a modificar
 *
 * @author Samu
 */

class VModificarActividad2{
    function __construct($listaActividad) {
        $this->render($listaActividad);
    }
    
    function render($listaActividad){
?>
        <html>
            <head></head>
            <body>
                <h2>Seleccione el Actividad a modificar:</h2>
                <form action="../controller/CActividad2.php" method="post">
                    <div>
                        <p>Selecione la ID del Actividad a modificar:</p>
<?php
        $tupla=$listaActividad->fetch_row();
        do{
            echo "<input type='radio' name='Id_Actividad' value='$tupla[0]'>$tupla[0] -> $tupla[1]<br>";
            $tupla=$listaActividad->fetch_row();
        }while(!is_null($tupla));
?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                    </div>
                </form>
            </body>
        </html>

<?php
    }
    
    static function mostrarFormulario($Id_Actividad){
?>
        <html>
            <head></head>
            <body>
                <h2>Formulario de modificacion del Actividad:</h2>
                <form action="../controller/CActividad2.php" method="post">
<?php
        echo "<input type='hidden' name='Id_Actividad' value='$Id_Actividad'/>";
?>
                    <div>
                        <label for="Nombre">Nombre del Actividad:</label>
                        <input type="text" name="Nombre" size="30"/>
                    </div>
                    <div>
                        <label for="Sala">Sala:</label><br>
                       <input type="text" name="Sala" size="9"/>
                    </div>
                     <div>
                        <label for="Capacidad">Capacidad:</label>
                        <input type="text" name="Capacidad" size="30"/>
                    </div>
                     <div>
                        <label for="HoraInicio">Hora Inicio:</label>
                        <input type="time" name="HoraInicio" size="30"/>
                    </div>
                    <div>
                        <label for="HoraFin">Hora Fin:</label>
                        <input type="time" name="HoraFin" size="30"/>
                    </div>
                    
                     <div>
                        <label for="Dia">Dia:</label><br>
                         <select name="Dia">
                     <option>Lunes</option>
                    <option>Martes</option>
                    <option>Miercoles</option>
                    <option>Jueves</option>
                    <option>Viernes</option>
                    <option>Sabado</option>
                      </select>
                     

                    </div>
                    <div>
                        <button type="submit" name="action" value="modificacion">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
            </body>
	</html>
<?php
    }
}
?>
