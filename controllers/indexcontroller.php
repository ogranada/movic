<?php

// Importamos el controlador base
include BASEDIR."/utils/basecontroller.php";

/**
 * IndexController es una clase que hereda de base controller,
 * es decir que tiene todas las funcionalidades de base controller
 * pero no se ve todo el código que hay adentro.
 */
class IndexController extends BaseController {

  /**
   * Sobreescribe (reemplaza) el metodo render del controlador base
   * para pasar parametros personalizados
   */
  public function render() {
    $data = array(
      "a" => 1
    );
    parent::render($data);
  }

}

// Retorna la clase para que pueda ser usada por el resto de modulos.
return IndexController;

?>