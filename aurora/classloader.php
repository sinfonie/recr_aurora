<?php

$classloader = function ($classname) {
  $namespaceName = 'Aurora';
  if (substr($classname, 0, strlen($namespaceName)) !== $namespaceName) {
    return null;
  }
  $path = str_replace($namespaceName . '\\', '', $classname) . '.php';
  $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
  if (file_exists($path)) {
    require_once $path;
  }
};

spl_autoload_register($classloader);
