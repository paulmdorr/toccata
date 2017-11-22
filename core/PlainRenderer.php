<?php
class PlainRenderer implements Renderer {
  public function render(array $options) {
    foreach ($options['params'] as $param => $value) {
      $options['template'] = preg_replace('/«'.$param.'»/', $value, $options['template']);
    }

    echo $options['template'];
  }
}