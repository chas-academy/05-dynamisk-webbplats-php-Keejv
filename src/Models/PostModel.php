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
      $this->db->beginTransaction(); // Tell PDO we're going to use transactions

      // 1) Add to posts
      $createPostQuery = 'INSERT INTO posts (title, content, date, author_id, category_id) VALUES (?, ?, NOW(), ?, ?)';
      $statement = $this->db->prepare($createPostQuery);
      $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);

      $postSuccessfullyCreated = $statement->execute([
        $newPost['title'],
        $newPost['content'],
        $newPost['author_id'],
        $newPost['category_id']
      ]);

      $postId = $this->db->lastInsertId();

      // 2) Add selected tags to post_tags with the newly created post
      if (isset($postId)) {
          foreach ($newPost['tags'] as $tagId) {
              $insertPostTagsQuery = 'INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)';
              $statement = $this->db->prepare($insertPostTagsQuery);
              $tagsSuccessfullyCreated = $statement->execute([$postId, $tagId]);
          }
      }

      if (!$tagsSuccessfullyCreated) {
        throw new \Exception('Something went horribly wrong when trying to add the tag ids to the post');
      }

      if ($postSuccessfullyCreated && $tagsSuccessfullyCreated) {
        $this->db->commit(); // All good save the values
        return true;
      } else {
        $this->db->rollBack(); // Something went wrong, don't save anything
        throw new \Exception('Something went horribly wrong when trying to add the tag ids to the post');
      }
  }

  public function update(int $postId, array $newPost)
  {
    $this->db->beginTransaction();

    // 1) Update post in posts table
    $updatePostQuery = 'UPDATE posts SET title = ?, content = ?, category_id = ? WHERE id = ?;';
    $statement = $this->db->prepare($updatePostQuery);

    $postUpdated = $statement->execute([
      $newPost['title'],
      $newPost['content'],
      $newPost['category_id'],
      $postId
    ]);

    if (!$postUpdated) {
      throw new \Exception('Something went horribly wrong when trying to update the post');
    }

    // 2 a)
    $deletePostTagsQuery = 'DELETE FROM post_tags WHERE post_id = ?';
    $statement = $this->db->prepare($deletePostTagsQuery);
    $postTagsDeleted = $statement->execute([$postId]);

    if (!$postTagsDeleted) {
      throw new \Exception('Something went horribly wrong when trying to delete the tags for the post');
    }

    $postTagsCreated = false;

    // 2 b) Re-add all tagids, from $newPost['tags'] for the $postId into post_tags
    if ($newPost['tags'][0] === 'NULL') {
      $postTagsCreated = true;

    } else {
      foreach ($newPost['tags'] as $tagId) {
        $insertPostTagsQuery = 'INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)';
        $statement = $this->db->prepare($insertPostTagsQuery);
        $postTagsCreated = $statement->execute([$postId, $tagId]);

        if (!$postTagsCreated) {
            throw new \Exception('Something went horribly wrong when trying to add the tags for the post');
        }
      }
    }

    if ($postUpdated && $postTagsDeleted && $postTagsCreated) {
      $this->db->commit();
      return true;
    } else {
      $this->db->rollBack();
      throw new \Exception('Could not finish the update of the post. Please try again');
    }
  }

  public function delete(int $postId)
  {
    $query = 'DELETE FROM posts WHERE id = ?';
    $statement = $this->db->prepare($query);
    $statement->setFetchMode(PDO::FETCH_CLASS, self::CLASSNAME);
    return $statement->execute([$postId]);
  }
}
