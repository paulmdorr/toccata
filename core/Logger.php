<?php
abstract class Logger {
  const TYPE_DEBUG = 'debug';
  const TYPE_WARNING = 'warning';
  const TYPE_ERROR = 'error';

  public abstract function Log(string $message, string $type = self::TYPE_DEBUG);
}