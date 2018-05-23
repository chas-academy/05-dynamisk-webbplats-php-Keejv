<?php

namespace Blogg\Controllers;

use Blogg\Core\Connection;
use Blogg\Models\PostModel;
use Blogg\Models\TagModel;

class AdminController extends AbstractController
{
  protected $postModel;
  protected $tagModel;

  public function __construct()
  {
    $this->postModel = new PostModel();
    $this->tagModel = new TagModel();
  }

  public function dashboard()
  {
    $posts = $this->postModel->getAll();
    $tags = $this->tagModel->getAll();

    $viewData = [
      'posts' => $posts,
      'tags' => $tags
    ];

    return $this->render('admin/dashboard', $viewData);
  }
}