<?php

function menus(){
	echo  '<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gimnasio de ABP</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">¡

</head>
 <body>

    <div id="wrapper">
	<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Gimnasio ABP</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">';
		if (isset($_SESSION['Nombre'])){		
             echo  '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>'. $_SESSION['Nombre'].  '<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../core/Desconexion.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a>
                        </li>
                    </ul>';
		}else{ echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Invitado<b class="caret"></b></a>';}
         echo  '</li>
            </ul>
            <!-- Menu lateral -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="../index.php"><i class="inicio"></i>Inicio</a>
                    </li>';
if (isset($_SESSION['Id_PerfilUsuario'])){
    if($_SESSION['Id_PerfilUsuario']==1){
			echo	'<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#usuario"><i class="user"></i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="usuario" class="collapse">
                            <li>
                                <a href="../controller/CUsuario.php?action=alta" >Nuevo Usuario</a>
                            </li>
                            <li>
                                <a href="../controller/CUsuario.php?action=modificacion">Modificar Usuario</a>
                            </li>
							<li>
                                <a href="../controller/CUsuario.php?action=baja">Borrar Usuario</a>
                            </li>
							<li>
                                <a href="../controller/CUsuario.php?action=consulta">Buscar Usuario</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#actividad"><i class="activity"></i> Actividades <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="actividad" class="collapse">
                            <li>
                                <a href="../controller/CActividad2.php?action=alta" >Nueva Actividad</a>
                            </li>
                            <li>
                                <a href="../controller/CActividad2.php?action=modificacion">Modificar Actividad</a>
                            </li>
							<li>
                                <a href="../controller/CActividad2.php?action=baja">Borrar Actividad</a>
                            </li>
							<li>
                                <a href="../controller/CActividad2.php?action=consulta">Buscar Actividad</a>
                            </li>
							</ul>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#recurso"><i class="resource"></i> Recursos <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="recurso" class="collapse">
                            <li>
                                <a href="../controller/CRecurso.php?action=alta" >Nuevo Recurso</a>
                            </li>
                            <li>
                                <a href="../controller/CRecurso.php?action=modificacion">Modificar Recurso</a>
                            </li>
							<li>
                                <a href="../controller/CRecurso.php?action=baja">Borrar Recurso</a>
                            </li>
							<li>
                                <a href="../controller/CRecurso.php?action=consulta">Buscar Recurso</a>
                            </li>
                        </ul>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#verperfil"><i class="verperfil"></i> Ver mi Perfil <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="verperfil" class="collapse">
                           <li>
                                <a href="../controller/CUsuario.php?action=verPerfil">Ver Perfil</a>
                            </li>
                           
                            </ul>
                    </li>';
	}	
    if($_SESSION['Id_PerfilUsuario']==2){
    
echo    '<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ejercicio"><i class="ejercicio"></i> Ejercicios <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ejercicio" class="collapse">
                            <li>
                                <a href="../controller/CEjercicio.php?action=alta" >Añadir ejercicio</a>
                            </li>
                            <li>
                                <a href="../controller/CEjercicio.php?action=consulta">Buscar Ejercicio</a>
                            </li>
                            <li>
                                <a href="../controller/CEjercicio.php?action=verEjercicio">Ver Ejercicio</a>
                            </li>
                           
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#tabla"><i class="tabla"></i> Tablas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="tabla" class="collapse">
                            <li>
                                <a href="../controller/CTabla.php?action=alta" >Crear/Asignar Tabla</a>
                            </li>
                            <li>
                                <a href="../controller/CTabla.php?action=consulta">Buscar Tabla Actividad</a>
                            </li>
                            <li>
                                <a href="../controller/CTabla.php?action=verTabla">Ver Tablas</a>
                            </li>
                            <li>
                                <a href="../controller/CTabla.php?action=verAsignacion">Ver Asignacion Tablas</a>
                            </li>
                            </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#sesion"><i class="sesion"></i> Sesiones <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="sesion" class="collapse">
                            <li>
                                <a href="../controller/CSesion.php?action=cargarVerSesion">Ver Sesiones</a>
                            </li>
                        
                            <li>
                                <a href="../controller/CSesion.php?action=consulta">Buscar Sesiones</a>
                            </li>
                            
                        </ul>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#verperfil"><i class="verperfil"></i> Ver mi Perfil <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="verperfil" class="collapse">
                           <li>
                                <a href="../controller/CUsuario.php?action=verPerfil">Ver Perfil</a>
                            </li>
                           
                            </ul>
                    </li>';


    }
    
if($_SESSION['Id_PerfilUsuario']==3 || $_SESSION['Id_PerfilUsuario']==4 ){
    
echo    '<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#actividad"><i class="actividad"></i> Actividades <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="actividad" class="collapse">
                            <li>
                                <a href="../controller/CActividad2.php?action=consulta">Buscar Actividad</a>
                            </li>
                           <li>
                                <a href="../controller/CActividad2.php?action=verActividad" >Ver Actividad</a>
                            </li>
                            
                           
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#tabla"><i class="tabla"></i> Tablas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="tabla" class="collapse">
                           <li>
                                <a href="../controller/CTabla.php?action=principal">Ver Tablas</a>
                            </li>
                           
                            </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#sesion"><i class="sesion"></i> Sesiones <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="sesion" class="collapse">
                        <li>
                                <a href="../controller/CSesion.php?action=cargarAlta">Iniciar Sesion</a>
                            </li>
                        
                            <li>
                                <a href="../controller/CSesion.php?action=consulta">Buscar Sesiones</a>
                            </li>
                            <li>
                                <a href="../controller/CSesion.php?action=verSesion">Ver Sesiones</a>
                            </li>
                        
                    </li>
                            
                        </ul>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#verperfil"><i class="verperfil"></i> Ver mi Perfil <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="verperfil" class="collapse">
                           <li>
                                <a href="../controller/CUsuario.php?action=verPerfil">Ver Perfil</a>
                            </li>
                           
                            </ul>
                    </li>'
                    ;


    }
    


    

}   
	   
	   echo      '</ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>';

	
}