<?php 

// Error messages on
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// importera databas-connection-klassen
require_once('./core/Connection.php');

// Spar anslutningen till databasen i variabeln $db
$db = Connection::getInstance()->handler;

if (isset($_POST['post_id'])) {
    $sql = 'DELETE FROM posts WHERE id = :id';

    $statement = $db->prepare($sql);
    $statement->bindValue(':id', $_POST['post_id']);
    $statement->execute();

    header('Location: /');
}

?>