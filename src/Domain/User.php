<?php
    namespace Blogg\Domain;

    class User {
        private $id;
        private $email;
        private $username;

        public function getId(): int
        {
            return $this->id;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getUsername(): string
        {
            return $this->username;
        }
    }