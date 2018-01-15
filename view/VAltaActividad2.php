<?php
/**
 * Vista que muestra un formulario para dar de alta un Usuario
 *
 * @author Samu
 */


class VAltaActividad2{
    function __construct() {
        $this->render();
    }
    
    function render(){
      menus();
?>
      
       <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
              Nueva Actividad <small>Introduzca los datos de actividad</small>
                        </h1>
                    </div>
                </div>
                <form action="../controller/CActividad2.php" method="post">
                    <div>
                        <label for="nombreAc">Nombre del Usuario:</label>
                        <input type="text" name="nombreAc" size="30"/>
                    </div>
                    <div>
                        <label for="sala">sala:</label><br>
                        <input type="text" name="sala" size="9"/>

                    </div>
                     <div>
                        <label for="Capacidad">Capacidad:</label><br>
                        <input type="text" name="Capacidad" size="9"/>

                    </div>
                     <div>
                        <label for="HoraInicio">Hora inicio:</label><br>
                        <input type="time" name="HoraInicio" size="9"/>

                    </div>
                     <div>
                        <label for="HoraFin">Hora Fin:</label><br>
                        <input type="time" name="HoraFin" size="9"/>

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
                        <button type="submit" name="action" value="alta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
           
<?php
footer();
    }
}
?>