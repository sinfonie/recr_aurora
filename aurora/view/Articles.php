<?php

namespace Aurora\View;

use Aurora\Classes\Page;

class Articles extends Page
{
  public function getHtml(): string
  {
    return '<div class="container mt-2">
              <div class="jumbotron">
                <h1 class="display-4">Artykuły</h1>
                <form action="/articles" id="add-article" method="post"></form>
                <p><button form="add-article" class="btn btn-primary btn-sm" role="button" name="db_add" value="article">Dodaj artykuł</button></p>
                <hr class="my-4">
                <div class="container">' .
      $this->showArticles()
      . '</div>
            </div>
          </div>';
  }

  public function showArticles()
  {
    $output = '';
    if (!empty($this->data)) {
      foreach ($this->data as $article) {
        $output .= '<div class="row row-cols-7 border-bottom">';
        foreach ($article as $key => $field) {
          if ($key === 'category_id') continue;
          $output .= '<div class="col p-2">' . $field . '</div>';
        }
        $output .= '<div class="col p-2">
                      <a class="btn btn-primary btn-sm" href="/articles/' . $article->id . '" role="button">Edytuj</a>
                    </div>
                  </div>';
      }
    } else {
      $output .= 'Dodaj artykuł';
    }
    return $output;
  }
}
