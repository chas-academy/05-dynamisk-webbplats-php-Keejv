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
        $statement->execute([$tagId]);

        $tag = $statement->fetch();

        return $tag;
    }

    public function delete(int $tagId)
    {
        $query = 'DELETE FROM tags WHERE id = ?';
        $sth = $this->db->prepare($query);

        if (!$sth->execute([$tagId])) {
            throw new \Exception('Something went horribly wrong when trying to delete the tag');
        }

        return $sth->execute([$tagId]);
    }

    public function create(string $tagName)
    {
        $this->db->beginTransaction();

        $createTagQuery = 'INSERT INTO tags (tag_name) VALUES (?)';
        $sth = $this->db->prepare($createTagQuery);

        $tagCreated = $sth->execute([
            $tagName
        ]);

        if ($tagCreated) {
            $this->db->commit();
            return true;
        } else {
            $this->db->rollBack();
            throw new \Exception('Something went horribly wrong when trying to create the tag');
        }
    }

    public function update(int $tagId, string $tagName)
    {
        $this->db->beginTransaction();

        $updateTagQuery = 'UPDATE tags SET tag_name = ? WHERE id = ?';
        $sth = $this->db->prepare($updateTagQuery);

        $tagUpdated = $sth->execute([
            $tagName,
            $tagId
        ]);

        if (!$tagUpdated) {
            throw new \Exception('Something went horribly wrong when trying to update the tag');
        }

        if ($tagUpdated) {
            $this->db->commit();
        } else {
            $this->db->rollBack();
        }
    }
}
