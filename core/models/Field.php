<?php
class Field {
  public $type;
  public $value;
  
  private $options;

  public function __construct(FieldType $type, array $options) {
    $this->type = $type;
    $this->options = $options;
  }

  /**
   * Allows to set a validator function through the options, otherwise it calls
   * the FieldType validator.
   * 
   * TODO: see if it's possible/useful/necessary to add validator params
   */
  public function validate() {
    if (isset($this->options['validator']) && is_callable($this->options['validator'])) {
      $this->options['validator']();
    } else {
      $this->type->validate();
    }
  }
}