<?php

namespace Aurora\Config;

class Configuration {

  private static $settings = [
    'host' => 'db:3306',
    'username' => 'aurora',
    'password' => 'aurora',
    'db_name' => 'aurora',
    'db_prefix' => 'ar_',
    'engine' => 'InnoDB',
    'charset' => 'utf8',
  ];

  public static function get() {
    return self::$settings;
  }
}