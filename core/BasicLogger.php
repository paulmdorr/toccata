<?php
class BasicLogger extends Logger {
  public function Log($message, $type = self::TYPE_DEBUG) {
    //TODO: change this to use config path
    $filename = __DIR__ . '/../logs/' . $type;
    $handle = fopen($filename, 'a') or die('Cannot open file:  '.$filename); //implicitly creates file

    $timestamp = '[' . date('Y-m-d H:i:s') . ']» ';

    fwrite($handle, $timestamp . $message . "\n");
    fclose($handle);
  }
}