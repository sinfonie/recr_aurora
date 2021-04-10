<?php

namespace Aurora\Controllers;

use \Aurora\Classes\Data;
use \Aurora\Classes\Request;
use \Aurora\Controllers\Router;
use \Aurora\Controllers\View;

class MainController
{

  public function __construct()
  {
    $this->getRequest();
    $router = new Router;
    $data = $this->getData($router);
    $view = new View($router, $data);
    echo $view->returnView();
  }

  public function getRequest()
  {
    //zrobić fabrykę
    $request = array_merge($_GET, $_POST);
    if (isset($request['db_update'])) {
      if ($request['db_update'] === 'article') Request::updateArticle($request);
    }
    if (isset($request['db_add'])) {
      if ($request['db_add'] === 'article') Request::addArticle();
    }
    if (isset($request['db_delete'])) {
      if ($request['db_delete'] === 'article') Request::deleteArticle($request);
    }
    if (isset($request['db_drop'])) {
      if ($request['db_drop'] === 'article') Request::dropDatabase();
    }
  }

  public function getData($router): array
  {
    switch ($router->page) {
      case 'Homepage':
        $data = [];
        break;
      case 'Articles':
        $data = Data::getArticles();
        break;
      case 'Article':
        $data = Data::getArticle($router->params);
        break;
      default:
        $data = [];
    }
    return $data;
  }
}
