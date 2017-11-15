<?php
class Toccata {
  const BASE_APP_DIR = __DIR__ . '/../App';

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

  public static function getLogger() {
    return self::$logger;
  }

  private static function autoload() {
    //Including classes just by name, for the moment
    spl_autoload_register(function ($class) {
      $original_filename = $class . '.php';
      $full_path_filename = __DIR__ . '/' . $original_filename;

      if (file_exists($full_path_filename)) {
        include $full_path_filename;
      } else {
        // Trying to load the class from the App root
        $filename = '../App/' . $original_filename;

        if (file_exists($filename)) {
          include $filename;
        } else {
          // Trying to load the class from the App subdirs (Controllers, Models, etc)
          $dir = new DirectoryIterator(self::BASE_APP_DIR);
          foreach ($dir as $fileinfo) {
              if (!$fileinfo->isDot() && $fileinfo->isDir()) {
                $filename = self::BASE_APP_DIR . '/' . $fileinfo->getFilename() . '/' . $original_filename;

                if (file_exists($filename)) {
                  include $filename;
                }
              }
          }
        }
      }
    });
  }
}