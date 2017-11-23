<?php
abstract class Model {
  protected $fields = [];

  protected function addField(string $name, FieldType $type, array $options = []) {
    //TODO: throw exception if field exists
    if (isset($name, $this->fields)) {
      $this->fields[$name] = new Field($type, $options);
    }
  }

  public function __get(string $field) {
    if (ctype_upper($field[0])) {
      return $this->fields[lcfirst($field)];
    } else {
      return $this->fields[$field]->value;
    }
  }

  public function __set(string $field, $value) {
    return $this->fields[lcfirst($field)]->value = $value;
  } 
}