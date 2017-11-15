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

        $controller = new $this->routes[$route][0]($this);
        $controller->$method();
      }
    }
  }

  public function redirect($controllerName, $methodName) {
    foreach ($this->routes as $key => $value) {
      $method_is_index = $methodName === 'index' && !isset($value[1]);
      if (in_array($controllerName, $value) && (in_array($methodName, $value) || $method_is_index)) {
        header('Location: ' . $key);
      }
    }
  }

  private function sendBadRequestMethodResponse($method) {
    $this->api->setResponseHeaders(400);
    echo json_encode(['errors' => [
      ['Title' => 'Wrong request method'],
      ['Detail' => "This endpoint only accepts $method method."]
    ]]);
  }

  private function sendRequestParameterMissing($parameter) {
    $this->api->setResponseHeaders(400);
    echo json_encode(['errors' => [
      ['Title' => 'Missing parameter'],
      ['Detail' => "The $parameter parameter is required."]
    ]]);
  }
}
