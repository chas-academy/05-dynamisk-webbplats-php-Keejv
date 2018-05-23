<?php
    namespace Blogg\Domain;

    class Category {
        private $id;
        private $category_name;

        public function getId(): int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->category_name;
        }
    }