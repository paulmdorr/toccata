<?php

class Router {
  private const ROUTES_FILE_NAME = '../routes.json';

  private $routes;

  function __construct() {
    $this->routes = json_decode(
      file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . static::ROUTES_FILE_NAME), true);
  }

  public function processRequest() {
    $route = $_SERVER['REQUEST_URI'];
    if (key_exists($route, $this->routes)) {
      if (isset($this->routes[$route][0])) {
        $method = isset($this->routes[$route][1]) ? $this->routes[$route][1] : 'index';
        
        try {
          $controller = new $this->routes[$route][0]($this);
        } catch (\Error $e) {
          $this->PageNotFound("Wrong controller «{$this->routes[$route][0]}» defined on route «{$route}».");
          return;
        }

        if (is_callable(array($controller, $method))) {
          $controller->$method();
        } else {
          $this->PageNotFound("Tried to call wrong method «{$method}» on controller «{$this->routes[$route][0]}».");
        }
      } else {
        $this->PageNotFound("Controller definition missing on route «{$route}».");
      }
    } else {
      $this->PageNotFound("Route «{$route}» not found.");
    }
  }

  private function PageNotFound($message) {
    Toccata::getLogger()->Log($message, Logger::TYPE_WARNING);
    $this->set404();
  }

  public function redirect($controllerName, $methodName) {
    foreach ($this->routes as $key => $value) {
      $method_is_index = $methodName === 'index' && !isset($value[1]);
      if (in_array($controllerName, $value) && (in_array($methodName, $value) || $method_is_index)) {
        header('Location: ' . $key);
      }
    }
  }

  private function set404() {
    http_response_code(400);
    include('404.php');
  }
}
