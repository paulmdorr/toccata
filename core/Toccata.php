<?php
class Toccata {
  const BASE_APP_DIR = __DIR__ . '/../app';

  private static $logger;

  public static function bootstrap() {
    self::autoload();
  }

  public static function start() {
    $router = new Router();
    $router->processRequest();
  }

  public static function setLogger(Logger $logger) {
    self::$logger = $logger;
  }

  public static function getLogger(): Logger {
    return self::$logger;
  }

  private static function autoload() {
    //Including classes just by name, for the moment
    spl_autoload_register(function ($class) {
      $original_filename = $class . '.php';
      $full_path_filename = __DIR__ . '/' . $original_filename;
      
      if (file_exists($full_path_filename)) {
        include $full_path_filename;
      } else if (!self::tryToIncludeFromSubDirs($original_filename, __DIR__)) {
        // Trying to load the class from the App root
        $filename = '../app/' . $original_filename;

        if (file_exists($filename)) {
          include $filename;
        } else {
          // Trying to load the class from the App subdirs (Controllers, Models, etc)
          self::tryToIncludeFromSubDirs($original_filename, self::BASE_APP_DIR);
        }
      }
    });
  }

  private static function tryToIncludeFromSubDirs($original_filename, $base_dir) {
    $dir = new DirectoryIterator($base_dir);
    foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot() && $fileinfo->isDir()) {
          $filename = $base_dir . '/' . $fileinfo->getFilename() . '/' . $original_filename;

          if (file_exists($filename)) {
            include $filename;
            return true;
          }
        }
    }
    return false;
  }
}