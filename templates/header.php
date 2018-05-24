<?php
    global $assetPath;
    if ($_SERVER['SERVER_NAME'] === 'blogg.kaveh.chas.academy') {
        $assetPath = 'http://' . $_SERVER['HTTP_HOST'] . '/web/';
    } else {
        $assetPath = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo $assetPath . "public/style.css " ?>">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
      rel="stylesheet">

  <title>Blog name</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="/">Blog name</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <?php if(isset($categories) && count($categories) > 0): ?>
              <?php foreach($categories as $category): ?>
                <li class="nav-item">
                  <a class="nav-link btn-outline" href="/post/category/<?php echo $category->getId() ?>"><?php echo $category->getName() ?></a>
                </li>
              <?php endforeach;?>
            <?php endif;?>
            <?php if(isset($_COOKIE['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success" href="/admin/dashboard">Admin dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="/logout">Log out</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="/login">Log in</a>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>

<header class="masthead" style="background-image: url('<?php echo $assetPath . 'public/images/mountains.jpg' ?>')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Blog name</h1>
                </div>
            </div>
        </div>
    </div>
</header>
