<?php

namespace Blogg\Models;

use PDO;

class CategoryModel extends AbstractModel
{
  const CLASSNAME = '\Blogg\Domain\Category';

  public function getAll()
  {
    $query = 'SELECT * FROM categories';

    $statement = $this->db->prepare($query);
    $statement->execute();

    $categories = $statement->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    return $categories;
  }

  public function get(int $categoryId)
  {
    $query = 'SELECT * FROM categories WHERE id = ?';
    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);
    $statement->execute([$postId]);

    $category = $statement->fetch();

    return $category;
  }
}
