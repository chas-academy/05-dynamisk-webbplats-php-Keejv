<?php

namespace Blogg\Models;

use PDO;

class TagModel extends AbstractModel
{
  const CLASSNAME = '\Blogg\Domain\Tag';

  public function getAll()
  {
    $query = 'SELECT * FROM tags';

    $statement = $this->db->prepare($query);
    $statement->execute();

    $tags = $statement->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    return $tags;
  }

  public function get(int $tagId)
  {
    $query = 'SELECT * FROM tags WHERE id = ?';
    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);
    $statement->execute([$postId]);

    $tag = $statement->fetch();

    return $tag;
  }

  /** CREATE READ UPDATE DELETE */
}
