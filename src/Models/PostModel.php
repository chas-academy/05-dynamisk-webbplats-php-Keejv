<?php

namespace Blogg\Models;

use PDO;

class PostModel extends AbstractModel
{
  const CLASSNAME = '\Blogg\Domain\Post';

  public function getAll()
  {
    $query = 'SELECT p.id, p.title, p.content, p.date,
              CONCAT(u.firstname, " ", u.surname) AS author, c.category_name AS category,
              GROUP_CONCAT(t.tag_name) AS tags,
              GROUP_CONCAT(t.id) AS tag_ids
              FROM posts p
              LEFT JOIN users u ON p.author_id = u.id
              LEFT JOIN categories c ON p.category_id = c.id
              LEFT JOIN post_tags pt ON p.id = pt.post_id
              LEFT JOIN tags t ON t.id = pt.tag_id
              GROUP BY p.id';

    $statement = $this->db->prepare($query);
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);

    return $posts;
  }

  public function get(int $postId)
  {
    $query = 'SELECT p.*,
              CONCAT(u.firstname, " ", u.surname) AS author, c.category_name AS category,
              GROUP_CONCAT(t.tag_name) AS tags,
              GROUP_CONCAT(t.id) AS tag_ids
              FROM posts p
              LEFT JOIN users u ON p.author_id = u.id
              LEFT JOIN categories c ON p.category_id = c.id
              LEFT JOIN post_tags pt ON p.id = pt.post_id
              LEFT JOIN tags t ON t.id = pt.tag_id
              WHERE p.id = ?
              GROUP BY p.id';

    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);
    $statement->execute([$postId]);

    $post = $statement->fetch();

    return $post;
  }

  public function create(array $newPost)
  {
    // 1) Add to posts
    $query = 'INSERT INTO posts (title, content, date, author_id, category_id) VALUES (?, ?, NOW(), ?, ?)';
    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);

    $statement->execute([
      $newPost['title'],
      $newPost['content'],
      1,
      $newPost['category_id']
    ]);

    $postId = $this->db->lastInsertId();

    // 2) Add selected tags to post_tags with the newly created post
    // ...
  }

  public function update()
  {

  }

  public function delete(int $postId)
  {
    $query = 'DELETE FROM posts WHERE id = ?';
    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);
    return $statement->execute([$postId]);
  }
}
