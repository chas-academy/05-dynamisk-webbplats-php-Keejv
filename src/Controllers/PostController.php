<?php

namespace Blogg\Controllers;

use Blogg\Core\Connection;
use Blogg\Core\Request;

use Blogg\Models\PostModel;
use Blogg\Models\CategoryModel;
use Blogg\Models\TagModel;

use Blogg\Controllers\ErrorController;

class PostController extends AbstractController
{
  protected $postModel;
  protected $categoryModel;
  protected $tagModel;

  protected $request;

  public function __construct(Request $request)
  {
    $this->postModel = new PostModel();
    $this->categoryModel = new CategoryModel();
    $this->tagModel = new TagModel();

    $this->request = $request;
  }

  public function start()
  {
    $posts = $this->postModel->getAll();

    $viewData = [
      'posts' => $posts
    ];

    return $this->render('home', $viewData);
  }

  public function get(int $postId)
  {
    $post = $this->postModel->get($postId);

    $viewData = [
      'post' => $post
    ];

    return $this->render('post', $viewData);
  }

  public function create()
  {
    if ($this->request->isGet()) {
      $categories = $this->categoryModel->getAll();
      $tags = $this->tagModel->getAll();

      $viewData = [
        'categories' => $categories,
        'tags' => $tags
      ];

      return $this->render('admin/post/createpost', $viewData);
    } else {
      // Get all of the parameters from the POST request
      $newPost = $this->request->getParams()->all();
      $postWasCreated = $this->postModel->create($newPost);

      if ($postWasCreated)
      {
        $this->redirect('/admin/dashboard');
      } else {
        $errorController = new ErrorController();
        return $errorController->generalError();
      }
    }
  }


  public function edit(int $postId)
  {
    $post = $this->postModel->get($postId);
    $categories = $this->categoryModel->getAll();
    $tags = $this->tagModel->getAll();

    $viewData = [
      'post' => $post,
      'categories' => $categories,
      'tags' => $tags
    ];

    return $this->render('admin/post/editpost', $viewData);
  }

  public function delete(int $postId)
  {
    $postWasDeleted = $this->postModel->delete($postId);

    if ($postWasDeleted)
    {
      return $this->redirect('/admin/dashboard');
    } else {
      $errorController = new ErrorController();
      return $errorController->generalError();
    }
  }


}