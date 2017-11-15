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

    $renderer = class_exists($rendererName) ? new $rendererName() : new PlainRenderer();

    return is_a($renderer, 'Renderer') ? $renderer : new PlainRenderer();
  }
}