<?php

namespace Aurora\View;

use Aurora\Classes\Page;

class Article extends Page
{
  public function getHtml(): string
  {
    return '<div class="container mt-2">
              <div class="jumbotron">
                <h1 class="display-4">Artykuły</h1>
                <hr class="my-4">
                <div class="container">' .
      $this->showArticle()
      . '</div>
            </div>
          </div>';
  }

  public function showArticle(): string
  {
    $output = '';
    if (!empty($this->data)) {
      $output .= '<form id="edit-form" method="post"></form>';
      $output .= '<form id="delete-form" action="/articles" method="post"></form>';
      foreach ($this->data as $key => $value) {
        $output .= '<div class="row row-cols-3 m-1 border-bottom p-2">
                      <div class="col">' . $key . '</div>
                      <div class="col">' . $this->getInput($key, $value) . '</div>
                    </div>';
      }
      $output .= '<input form="edit-form" type="hidden" name="article_id" value="' . $this->params . '">
                  <input form="edit-form" type="hidden" name="db_update" value="article">
                  <button form="edit-form" class="btn btn-primary btn-sm m-2">Zapisz</button>
                  <input form="delete-form" type="hidden" name="db_delete" value="article">
                  <input form="delete-form" type="hidden" name="article_id" value="' . $this->params . '">
                  <button form="delete-form" class="btn btn-danger btn-sm m-2">Usuń</button>';
    }
    return $output;
  }

  public function getInput($key, $value): ?string
  {
    if ($key == 'title' || $key == 'status') {
      return '<input form="edit-form" type="text" name="' . $key . '" value="' . $value . '">';
    } elseif ($key == 'description') {
      return '<textarea form="edit-form" row="3" cols="23" name="' . $key . '" value="' . $value . '">'.$value.'</textarea>';
    } else {
      return $value;
    }
  }
}
