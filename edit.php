<?php 

// Error messages on
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// importera databas-connection-klassen
require_once('./core/Connection.php');

// Spar anslutningen till databasen i variabeln $db
$db = Connection::getInstance()->handler;


if ($_GET['id']) {

    // hämta posten med detta id, lyssna efter POST request isf  uppdatera

    $statement = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $statement->bindValue(':id', $_GET['id']);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    echo '
    <form action="" method="POST">
        <input type="text" name="title" value="' . $post['title'] . '" />
        <textarea name="content">' . $post['content'] . '</textarea>
        <input type="hidden" name="id" value=' . $post['id'] . ' />
        <button type="submit">Uppdatera</button>
    </form>';
    
}

if (isset($_POST['title'])) {

    $sql = 'UPDATE posts set title = :title, content = :content WHERE id = :id';

    $statement = $db->prepare($sql);
    $statement->bindValue(':title', $_POST['title']);
    $statement->bindValue(':content', $_POST['content']);
    $statement->bindValue(':id', $_POST['id']); 

    $statement->execute();

    header('Location: /');

}


if ($_GET['id']) {
    
        // hämta posten med detta id, lyssna efter POST request isf  uppdatera
    
        $statement = $db->prepare('SELECT * FROM tags WHERE id = :id');
        $statement->bindValue(':id', $_GET['id']);
        $statement->execute();
        $post = $statement->fetch(PDO::FETCH_ASSOC);
    
        echo '
        <form action="" method="POST">
            <input type="text" name="title" value="' . $post['title'] . '" />
            <textarea name="content">' . $post['content'] . '</textarea>
            <input type="hidden" name="id" value=' . $post['id'] . ' />
            <button type="submit">Uppdatera</button>
        </form>';
        
    }




function echoPre($args) {
    echo '<pre>';
        print_r($args);
    echo '<pre>';
}

?>