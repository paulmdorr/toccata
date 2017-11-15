<?php
abstract class Controller {
  protected $router;

  public function __construct($router) {
    $this->router = $router;
  }

  protected function redirect($controllerName, $methodName = 'index') {
    $this->router->redirect($controllerName, $methodName);
  }

  protected function getRenderer($name) {
    $rendererName = $name.'Renderer';

    if (class_exists($rendererName)) {
      $renderer = new $rendererName();
    } else {
      $renderer = new PlainRenderer();
      Toccata::getLogger()->Log(
        "$rendererName not found, falling back to PlainRenderer.", Logger::TYPE_WARNING);
    }

    if (is_a($renderer, 'Renderer')) {
      return $renderer;
    }
    
    Toccata::getLogger()->Log(
      "$rendererName is not implementing the Renderer interface, falling back to PlainRenderer.",
      Logger::TYPE_WARNING);
    return new PlainRenderer();
  }
}