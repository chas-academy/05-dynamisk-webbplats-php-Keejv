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
?>