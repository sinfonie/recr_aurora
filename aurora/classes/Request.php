<?php

namespace Aurora\Classes;

use \Aurora\Classes\Data;

class Request
{

  public static function updateArticle($request): void
  {
    if (is_numeric($request['article_id'])) {
      if (is_string($request['title'])) {
        Data::updateArticle('title', $request['title'], $request['article_id']);
      }
      if (is_string($request['status'])) {
        Data::updateArticle('status', $request['status'], $request['article_id']);
      }
      if (is_string($request['description'])) {
        Data::updateArticle('description', $request['description'], $request['article_id']);
      }
    }
  }

  public static function addArticle(): void
  {
    Data::addArticle('New Article Title', 'active', 'Lorem ipsum...');
  }

  public static function deleteArticle($request): void
  {
    if (is_numeric($request['article_id'])) {
      Data::deleteArticle($request['article_id']);
    }
  }

  public static function dropDatabase(): void
  {
    Data::dropDatabase();
  }
}
