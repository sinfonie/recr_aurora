<?php

namespace Aurora\Controllers;

use \Phroute\Phroute\RouteCollector;
use \Phroute\Phroute\Dispatcher;

class Router
{

  public $page = 'Homepage';
  public $params = null;

  private $routes = [
    '/' => [
      'page' => 'Homepage',
    ],
    'articles' => [
      'page' => 'Articles',
    ],
    'articles/{id}' => [
      'page' => 'Article',
      'params' => true,
    ],
  ];

  public function __construct()
  {
    $collector = $this->setRoutes();
    $this->dispatch($collector);
  }

  private function dispatch($collector)
  {
    $dispatcher =  new Dispatcher($collector->getData());
    try {
      $url = parse_url($_SERVER["REQUEST_URI"]);
      $output = $dispatcher->dispatch($_SERVER["REQUEST_METHOD"], $url['path']);
      $this->page = $output['page'];
      if (isset($output['params'])) {
        $this->params = $output['params'];
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  private function setRoutes()
  {
    $collector = new RouteCollector();
    foreach ($this->routes as $path => $params) {
      $collector->get($path, function ($id = null) use ($params) {
        if ($params) {
          $params['params'] = $id;
        }
        return $params;
      });
    }
    return $collector;
  }
}
