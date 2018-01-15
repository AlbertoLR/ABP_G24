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
      menus();
?>
       <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Buscar <small>Consulta Actividad</small>
                        </h1>
                    </div>
                </div>
               
                <form action="../controller/CActividad2.php" method="post">
                    <div>
                        <label for="Nombre">Nombre Actividad: </label>
                        <input type="text" name="Nombre" size="9"/>

                    </div>

                    <div>
                        <button type="submit" name="action" value="consulta">Enviar</button>
                        <button type="reset" name="reset" value="Borrar">Borrar</button>
                    </div>
                </form>
           
<?php
footer();
    }
    
    static function mostrar($resultado){
      menus();
?>
        
                <h2>Formulario de busqueda:</h2>
                <table class="table">
                    <thead>
                        <th>Nombre Actividad</th>
                        <th>Sala</th>
                        <th>Capadidad</th>
                          <th>Hora inicio</th>
                        <th>Hora Fin</th>
                          <th>Dia</th>
                   
                    </tr>
                </thead>
                <tbody>
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
    </tbody>
                </table>
         
<?php
 footer();
    }

}
?>