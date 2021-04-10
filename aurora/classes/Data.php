<?php

namespace Aurora\Classes;

use \Aurora\Classes\Db;

class Data
{

  public static function getArticles(): array
  {
    try {
      $pdo = Db::get()->pdo;
      $sth = $pdo->prepare("SELECT id, title, status, description, category_id, date_add, date_upd FROM ar_articles");
      $sth->execute();
      return $sth->fetchAll(\PDO::FETCH_CLASS);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return [];
    }
  }

  public static function getArticle(string $id): array
  {
    try {
      $pdo = Db::get()->pdo;
      $sth = $pdo->prepare("SELECT id, title, status, description, category_id, date_add, date_upd FROM ar_articles WHERE id=$id");
      $sth->execute();
      $ret = $sth->fetch(\PDO::FETCH_ASSOC);
      if (!$ret) {
        throw new \PDOException('Article doesn\'t exist');
        return [];
      }
      return $ret;
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return [];
    }
  }

  public static function addArticle(string $title, string $status, string $description)
  {
    try {
      $pdo = Db::get()->pdo;
      $sql = "INSERT INTO ar_articles (title, status, description) VALUES (?,?,?)";
      $sth = $pdo->prepare($sql);
      $sth->execute([$title, $status, $description]);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  public static function updateArticle(string $name, string $value,  string $id)
  {
    try {
      $pdo = Db::get()->pdo;
      $sql = "UPDATE ar_articles SET $name=? WHERE id=?";
      $pdo->prepare($sql)->execute([$value, $id]);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  public static function deleteArticle(string $id)
  {
    try {
      $pdo = Db::get()->pdo;
      $sql = "DELETE FROM ar_articles WHERE id=?";
      $pdo->prepare($sql)->execute([$id]);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  public static function dropDatabase()
  {
    try {
      $pdo = Db::get()->pdo;
      $sql = "DROP TABLE ar_articles";
      $pdo->prepare($sql)->execute();
      $sql = "DROP TABLE ar_categories";
      $pdo->prepare($sql)->execute();
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }
}
