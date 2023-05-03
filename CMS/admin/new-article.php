<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $conn = require '../includes/db.php';

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];

    if($article->create($conn)){
        Url::redirect("/CMS/admin/article.php?id={$article->id}");
    }
}
?>



<?php require "../includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>New Article</h2>

<?php require "includes/article-form.php"?>

<?php require "../includes/footer.php"?>