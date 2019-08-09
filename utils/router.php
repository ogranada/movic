<?php

/*
Que es _GET?
_GET es un arreglo que contiene los parametros query de la url
por ejemplo, si la URL es:
  http://localhost/myproyecto/demo.php?page=1

el contenido de _GET ha de ser:
  array( "page" => "1" )

*/

/**
 * Esta funcion carga un modulo de acuerdo a la ruta pasada como parametro.
 * Si hay un error grave 
 */
function loadModule($ruta) {
  if (file_exists($ruta)) {
    try {
      $instance = include $ruta;
      return $instance;
    } catch (\Throwable $th) {
      echo "<!-- // ". $th ." -->";
      return 500;
    }
  } else {
    return 400;
  }
}

/**
 * Esta función revisa los parametros enviados a la pagina mediante la variable $_GET
 * y de acuerdo a esto crea el controlador adecuado, el cual a su vez renderiza la vista
 * necesaria.
 */
function checkRoute() {
  $page_to_load = '';                      // variable que contiene que controlador debe cargar
  if ( array_key_exists('page', $_GET) ) { // si la variable page existe
    $page_to_load = $_GET['page'];         // extrae el valor y lo asigna a $page to load
  } else {                                 // de lo contrario
    $page_to_load = 'index';               // usa index que es el controlador por defecto.
  }
  // a continuación se carga el controlador de acuerdo a la variable $page_to_load
  $classname = @loadModule(BASEDIR."/controllers/$page_to_load"."controller.php");
  // se usa @loadModule para que no escriba warnings innecesarios.
  
  // Toma los datos obtenidos de la carga del controlador
  // si el valor retornado es 400 (no encuentra la pagina) carga la vista 400view.php
  // si el valor retornado es 500 (un error de la aplicación) carga la vista 500view.php
  // si todo salio bien usa el controlador obtenido y ejecuta la función render.
  switch ("$classname") {
    case "400":
      include BASEDIR."/views/404view.php";
      break;
    case "500":
      include BASEDIR."/views/500view.php";
      break;
    default:
      $instance = new $classname();
      $instance->render();
  }
}

checkRoute();

