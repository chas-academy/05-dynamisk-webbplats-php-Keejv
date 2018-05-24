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

  public function login(string $email, string $password)
  {
    $query = 'SELECT u.id, u.email, u.firstname, u.surname FROM users u WHERE email = ? AND password = ?';
    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);
    $statement->execute([$email, $password]);

    $user = $statement->fetch();

    return $user;
  }
}
