<?php

namespace Aurora\View;

use Aurora\Classes\Page;

class Homepage extends Page
{
  public function getHtml(): string
  {
    return '<div class="container mt-2">
              <div class="jumbotron">
                <h1 class="display-4">Aurora</h1>
                <p class="lead">Zadanie rekrutacyjne</p>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg" href="/articles" role="button">Przejdź do panelu</a>
              </div>
            </div>';
  }
}
