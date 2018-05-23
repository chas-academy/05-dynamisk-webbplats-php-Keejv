<?php
    namespace Blogg\Domain;

    class User {
        private $id;
        private $email;
        private $firstname;
        private $surname;

        public function getId(): int
        {
            return $this->id;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getName(): string
        {
            return $this->firstname . ' ' . $this->surname;
        }
    }