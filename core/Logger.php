<?php
abstract class Logger {
  const TYPE_DEBUG = 'debug';
  const TYPE_WARNING = 'warning';
  const TYPE_ERROR = 'error';

  public abstract function Log($message, $type = self::TYPE_DEBUG);
}