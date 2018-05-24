<?php

namespace Blogg\Controllers;

use Blogg\Core\Connection;
use Blogg\Core\Request;

use Blogg\Models\TagModel;

use Blogg\Controllers\ErrorController;

class TagController extends AbstractController
{
  protected $tagModel;

  protected $request;

  public function __construct(Request $request)
  {
    $this->tagModel = new TagModel();
    $this->request = $request;
  }

  public function get(int $tagId)
  {
    $tag = $this->tagModel->get($tagId);

    $viewData = [
      'tag' => $tag
    ];

    return $this->render('tag', $viewData);
  }

  public function create()
  {
    if ($this->request->isGet()) {
      return $this->render('admin/tag/createtag');
    } else {
      $tagName = $this->request->getParams()->get('name');
      $tagCreated = $this->tagModel->create($tagName);

      if ($tagCreated) {
        return $this->redirect('/admin/dashboard');
      } else {
        $errorController = new ErrorController();
        return $errorController->generalError();
      }
    }
  }

  public function update(int $tagId)
  {
    $tagName = $this->request->getParams()->get('name');

    try {
      $tagWasUpdated = $this->tagModel->update($tagId, $tagName);
    } catch (\Exception $e) {
      return $e->getMessage();
    }

    return $this->redirect('/admin/dashboard');
  }

  public function edit(int $tagId)
  {
    $tag = $this->tagModel->get($tagId);

    $viewData = [
      'tag' => $tag
    ];

    return $this->render('admin/tag/edittag', $viewData);
  }

  public function delete(int $tagId)
  {
    $tagWasDeleted = $this->tagModel->delete($tagId);

    if ($tagWasDeleted)
    {
      return $this->redirect('/admin/dashboard');
    } else {
      $errorController = new ErrorController();
      return $errorController->generalError();
    }
  }

}