<?php 

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if(isset($_GET['id'])){
    
    $article = Article::getByID($conn, $_GET['id']);

    if(! $article){
        die("Article Not Found");
    }
    

}else{
    
    die("id not supplied, article not found.");

}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];

    if($article->update($conn)){
        Url::redirect("/CMS/admin/article.php?id={$article->id}");
    }
        
    
}
?>

<?php require "../includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>Edit Article</h2>

<?php require "includes/article-form.php"?>

<?php require "../includes/footer.php"?>