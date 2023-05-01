<?php

require "classes/Database.php";
require 'classes/Article.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

if(!isLoggedIn()){
    die("unauthorised");
}

$article = new Article();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $db = new Database();
    $conn = $db->getConn();

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];

    if($article->create($conn)){
        redirect("/CMS/article.php?id={$article->id}");
    }
}
?>



<?php require "includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>New Article</h2>

<?php require "includes/article-form.php"?>

<?php require "includes/footer.php"?>