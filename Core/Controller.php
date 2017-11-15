<?php
class Controller {
  protected $router;

  public function __construct($router) {
    $this->router = $router;
  }

  protected function redirect($controllerName, $methodName = 'index') {
    $this->router->redirect($controllerName, $methodName);
  }
}