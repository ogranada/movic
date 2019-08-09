<?php

include BASEDIR."/models/model.php";

/**
 * BaseController es una clase que provee las funcionalidades minimas de un controlador.
 * Internamente BaseController permite:
 *  - Definir el nombre de la vista del controlador.
 *  - Renderizar la vista del controlador.
 *  - Renderizar vistas personalizadas.
 *  - Instanciar un modelo para acceder a la base de datos.
 */
class BaseController {

  protected $default_view = 'empty';
  protected $model;

  /**
   * Método constructor:
   * Éste metodo sirve para crear el objeto de tipo BaseController.
   * Cuando se ejecuta, éste llama al método configure.
   */
  public function __construct() {
    $this->configure(); // ejecuta el metodo configure
  }
  
  /**
   * Método configure:
   * Éste metodo sirve para configurar el objeto BaseController.
   * Cuando se ejecuta:
   *  - Define cual es el nombre del archivo de vista.
   *  - Instancia el modelo.
   */
  public function configure($viewName = NULL) {
    if( $viewName == NULL ) {       // verifica si recibe un nombre personalizado de vista
      $viewName = get_class($this); // en caso de no ser asi usa el nombre de la clase
    }
    // reemplaza en el nombre la palabla controller por view
    // entonces, si el nombre del controller es "indexcontroller" esto genera "indexview"
    $this->default_view = str_replace('controller', 'view', strtolower($viewName));
    // se conecta ala base de datos
    $this->model = Model::getInstance("localhost", 3306, "admin", "admin", "SampleDatabase");
  }

  /**
   * Renderiza una vista.
   * EL usuario puede pasar un arreglo de datos como parametro.
   * EL usuario puede pasar el nombre de la vista como parametro, si no se pasa
   * usa el valor que se configura por defecto.
   */
  public function render($params=array(), $view=NULL) {
    if ($view == NULL) {              // verifica que la vista sea nula
      $view = $this->default_view;    // en este caso usa la vista por defecto del controlador.
    }
    try {                                                // trata de ejecutar lo del bloque de código
      $render = include BASEDIR."/views/$view.php";  // intenta cargar la vista
      $render($params);
    } catch (\Throwable $th) {                           // si falla
      echo "Failure loading view: $th";                  // escribe el mensaje de fallo
    }
  }

  /**
   * Éste metodo es para definir como se puede convertir el objeto en cadena.
   */
  public function __toString() {
    return get_class($this);
  }

}

