<?php

    // Error messages on
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    error_reporting(E_ALL);

    use Blogg\Core\Router;
    use Blogg\Core\Request;

    // Exempelvis: Blogg\Models\Post
    function autoloader($classname)
    {
        $lastSlash = strpos($classname, '\\') + 1; // ['\', '\']
        $classname = substr($classname, $lastSlash); // Connection
        $directory = str_replace('\\', '/', $classname); // /Core/Connection
        $filename = __DIR__ . '/src/' . $directory . '.php'; // /vagrant/src/Core/Connection.php
        require_once($filename);
    }

    spl_autoload_register('autoloader'); // Tell php to autoload files using our autoloader

    $router = new Router();
    $response = $router->route(new Request());

    echo $response;

    // // importera databas-connection-klassen
    // require_once('./core/Connection.php');

    // // Spar anslutningen till databasen i variabeln $db
    // $db = Connection::getInstance()->handler;

    // /* posts */

    // // Gör en query mot databasen som vi sparar i variabeln $statement eftersom att vi vill
    // // hämta resultaten från queryn i ett senare skede
    // $statement = $db->query('SELECT * FROM posts');

    // // spar resultaten från queryn i results
    // $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    // /* categories */
    // $statement = $db->query('SELECT * FROM categories');
    // $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

    // $postsWithCategory = [];
    // foreach($posts as $key => $post) {

    //     $postsWithCategory[] = $post;

    //     foreach($categories as $category) {
    //         if ($post['category_id'] === $category['id']) {
    //             $postsWithCategory[$key]['category'] = $category['name'];
    //         }
    //     }

    // }

    // $statement = $db->query('SELECT * FROM tags');
    // $tags = $statement->fetchAll(PDO::FETCH_ASSOC);

    // $postsWithTags = [];
    // foreach($posts as $key => $post) {

    //     $postsWithTags[] = $post;

    //     foreach($tags as $tag) {
    //         if ($post['tag_id'] === $tag['id']) {
    //             $postsWithTags[$key]['tag'] = $tag['tags'];
    //         }
    //     }

    // }


    // include "theme.html";

    // if (isset ($_POST['username'])){
    //     $statement = $db->prepare('SELECT id, name, email FROM users WHERE name = :name AND password = :password LIMIT 1');

    //     $statement->bindValue(':name',$_POST['username'] );
    //     $statement->bindValue(':password',$_POST['password'] );

    //     $statement->execute();

    //     $user = $statement->fetch(PDO::FETCH_ASSOC);

    //     if (empty($user)){
    //         echo 'wrong user/password';
    //     }else{
    //          setcookie('user_id', $user['id']);
    //          header('Location: /');
    //         echo 'You are logged in ' . $user['name'];
    //     }

    // }


    // // Om någon har submittat formen och det finns ett värde i <input name="title">
    // if (isset ($_POST['title'])) {

    //     // förbered SQL-queryn
    //     $statement = $db->prepare('INSERT INTO posts (title, content, category_id) VALUES (:title, :content, :category_id)');

    //     // bindValue används för att "sanitizea" input-datan för motverka slippa SQL-injections
    //     $statement->bindValue(':title', $_POST['title']);
    //     $statement->bindValue(':content', $_POST['content']);
    //     $statement->bindValue(':category_id', $_POST['category_id']);

    //     // kör queryn efter bindValue
    //     $statement->execute();

    //     // Refresha sidan till URL: /
    //     header('Location: /');
    // }

    // //kan du skapa en användare din jävla idiot
    // if (isset ($_POST['create_username'])) {

    //             // förbered SQL-queryn
    //             $statement = $db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

    //             // bindValue används för att "sanitizea" input-datan för motverka slippa SQL-injections
    //             $statement->bindValue(':name', $_POST['create_username']);
    //             $statement->bindValue(':email', $_POST['set_email']);
    //             $statement->bindValue(':password', $_POST['set_password']);


    //             // kör queryn efter bindValue
    //             $statement->execute();

    //             // Refresha sidan till URL: /
    //             header('Location: /');
    //         }

    // function echoPre($args) {
    //     echo '<pre>';
    //         print_r($args);
    //     echo '<pre>';
    // }

    // function getAll($table) {
    //     $db = Connection::getInstance()->handler;
    //     $statement = $db->query('SELECT * FROM ' . $table);
    //     $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    //     return $results;
    // }

?>