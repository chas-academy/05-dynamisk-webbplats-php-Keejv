<?php
namespace Blogg\Controllers;
class ErrorController extends AbstractController
{
    public function notFound(): string
    {
        $properties = ['errorMessage' => 'Page not found!'];
        return $this->render('error', $properties);
    }

    public function requiresLogin(): string
    {
        return $this->redirect('/login');
    }

    public function generalError(): string
    {
        $properties = ['errorMessage' => 'Oops, something went wrong!'];
        return $this->render('error', $properties);
    }
}