<?php

namespace Blogg\Controllers;
abstract class AbstractController
{
  public function render(string $viewPath, array $viewData)
  {
    extract($viewData);

    ob_start();
    include_once 'templates/header.php';
    include_once 'views/' . $viewPath . '.php';
    include_once 'templates/footer.php';

    $renderedView = ob_get_clean();
    return $renderedView;
  }


  protected function redirect(string $url, array $params = null)
  {
      ob_start();
      header('Location: '.$url);
      ob_end_flush();
      die();
  }
}