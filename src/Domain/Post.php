<?php

namespace Blogg\Domain;

class Post
{
    private $id;
    private $title;
    private $content;
    private $date;
    private $author_id;
    private $category_id;
    private $author;
    private $category;
    private $tags;
    private $tag_ids;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPostDate()
    {
        return $this->date;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getTags(): string
    {
        if (empty($this->tags)) {
            $this->tags = 'No tags';
        }
        return $this->tags;
    }

    public function getTagIds(): array
    {
        if (empty($this->tag_ids)) {
            $this->tags = NULL;
        }
        return explode(',', $this->tag_ids);
    }


}