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
        $properties = ['errorMessage' => 'You must be logged in to do that!'];
        return $this->redirect('/signin', $properties);
    }

    public function generalError(): string
    {
        $properties = ['errorMessage' => 'Oops, something went wrong!'];
        return $this->render('error', $properties);
    }
}