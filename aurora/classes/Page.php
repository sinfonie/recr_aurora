<?php

namespace Aurora\Classes;

abstract class Page
{
  protected $data = [];
  protected $param = null;

  public function setData($data)
  {
    $this->data = $data;
  }

  public function setParam($param)
  {
    $this->params = $param;
  }

  abstract public function getHtml(): string;
}
