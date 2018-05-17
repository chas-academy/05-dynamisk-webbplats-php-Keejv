<?php
    //Db-referens för att nyttja till alla modellerna som extendar härifrån
    namespace Blogg\Models;

    use Blogg\Core\Connection;

    abstract class AbstractModel
    {
        protected $db;

        public function __construct()
        {
            $this->db = Connection::getInstance()->handler;
        }
    }
