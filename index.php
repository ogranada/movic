<?php 

////////////////////////////
// DEFINICIÓN DE GLOBALES //
////////////////////////////

// Se define BASEDIR para saber cual es la carpeta base desde donde se importan los modulos
$BASEDIR = getcwd();
define("BASEDIR", $BASEDIR, true);
$GLOBALS['BASEDIR'] = $BASEDIR;

//////////////////////////
// INICIO DE PALICACIÓN //
//////////////////////////

// Se importa el enrutador de la aplicación
include "$BASEDIR/utils/router.php";


?>