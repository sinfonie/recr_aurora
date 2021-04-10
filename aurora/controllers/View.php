<?php

namespace Aurora\Controllers;

use \Aurora\Controllers\Router;
use \Aurora\Classes\Page;

class View
{
  public function __construct(Router $router, array $data = [])
  {
    $this->page = $this->getPage($router->page);
    $this->page->setData($data);
    if (!is_null($router->params)) {
      $this->page->setParam($router->params);
    }
  }

  public function returnView(): string
  {
    $view = $this->getHeader();
    $view .= $this->page->getHtml();
    $view .= $this->getFooter();
    return $view;
  }

  public function getPage($page): ?Page
  {
    $class = '\Aurora\View\\' . $page;
    if (class_exists($class)) {
      if (is_a($class, '\Aurora\Classes\Page', true)) {
        return new $class;
      }
    }
    return null;
  }

  public function getHeader(): string
  {
    return '<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Aurora</title>
</head>
<body>
<div class="container">
  <nav class="navbar navbar-light bg-light">
    <a class="btn btn-dark" href="/">Powrót</a>
    <form id="drop-database" method="post"></form>
    <button form="drop-database" class="btn btn-danger btn-sm" role="button" name="db_drop" value="article">Zrzuć bazę</button>
  </nav>
</div>
';
  }

  public function getFooter(): string
  {
    return '</body></html>';
  }
}
