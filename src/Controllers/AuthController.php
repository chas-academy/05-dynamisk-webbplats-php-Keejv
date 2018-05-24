<?php

namespace Blogg\Controllers;

use Blogg\Core\Connection;
use Blogg\Core\Request;

use Blogg\Models\UserModel;

class AuthController extends AbstractController
{
    protected $userModel;
    protected $request;

    public function __construct(Request $request)
    {
        $this->userModel = new UserModel();
        $this->request = $request;
    }

    public function login()
    {
        if ($this->request->isGet()) {
            return $this->render('login');
        } else {
            $email = $this->request->getParams()->get('email');
            $password = $this->request->getParams()->get('password');

            $user = $this->userModel->login($email, $password);

            if (!empty($user)) {
                setcookie('user', $user->getId());
                return $this->redirect('/admin/dashboard');
            } else {
              return $this->render('login', ['message' => 'Incorrect credentials']);
            }
        }
    }

    public function logout()
    {
      setcookie('user', '', time()-5000);
      return $this->redirect('/');
    }
}
