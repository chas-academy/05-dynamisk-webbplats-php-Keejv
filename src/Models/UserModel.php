<?php

namespace Blogg\Models;

use Blogg\Domain\User;
use PDO;

class UserModel extends AbstractModel
{
  const CLASSNAME = '\Blogg\Domain\User';

  public function getAll()
  {
    $query = 'SELECT * FROM users';
    $statement = $this->db->prepare($query);
    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    return $users;
  }
}
