<?php
    namespace Blogg\Domain;

    class Tag {
        private $id;
        private $tag_name;

        public function getId(): int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->tag_name;
        }
    }