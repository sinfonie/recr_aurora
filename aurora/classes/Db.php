<?php

namespace Aurora\Classes;

use \Aurora\Config\Configuration;

class Db
{
  private static $instance;

  public static function get(): self
  {
    if (!self::$instance) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  private function __construct()
  {
    $conf = Configuration::get();
    $this->pdo = new \PDO("mysql:host=" . $conf['host'] . ";dbname=" . $conf['db_name'], $conf['username'], $conf['password']);
    $this->installDB($conf);
  }

  private function installDB($conf)
  {
    $databases = $this->createDatabases($conf);
    foreach ($databases as $db) {
      try {
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec($db);
      } catch (\PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  private function createDatabases($conf)
  {
    $sql[] = 'CREATE TABLE IF NOT EXISTS ' . $conf['db_prefix'] . 'categories (
    `id` int(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(32) NOT NULL,
    `date_add` datetime DEFAULT CURRENT_TIMESTAMP,
    `date_upd` datetime NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE = ' . $conf['engine'] . ' DEFAULT CHARSET = ' . $conf['charset'];

    $sql[] = 'CREATE TABLE IF NOT EXISTS ' . $conf['db_prefix'] . 'articles (
    `id` int(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` varchar(32) NOT NULL, 
    `status` varchar(16) NOT NULL,
    `description` varchar(32) NOT NULL,
    `category_id` int(9) DEFAULT NULL references categories(id),
    `date_add` datetime DEFAULT CURRENT_TIMESTAMP,
    `date_upd` datetime NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE = ' . $conf['engine'] . ' DEFAULT CHARSET = ' . $conf['charset'];
    return $sql;
  }
}
