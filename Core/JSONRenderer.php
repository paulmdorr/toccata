<?php
class JSONRenderer implements Renderer {
  public function render($options) {
    header('Content-Type: application/json');
    echo json_encode($options['params']);
  }
}