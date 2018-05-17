<?php

namespace Blogg\Controllers;

use Blogg\Core\Connection;
use Blogg\Models\UserModel;

class DefaultController extends AbstractController
{
  public function start()
  {
    return 'Hej från start@DefaultController';
  }

  public function getAll()
  {
    $userModel = new UserModel();
    $users = $userModel->getAll();

    $viewData = [
      'users' => $users
    ];

    return $this->render('kaveh', $viewData);
  }
}