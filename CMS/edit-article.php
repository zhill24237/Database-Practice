<?php 

require "classes/Database.php";
require 'classes/Article.php';
require "includes/url.php";

$db = new Database();
$conn = $db->getConn();

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
        redirect("/CMS/article.php?id={$article->id}");
    }
        
    
}
?>

<?php require "includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>Edit Article</h2>

<?php require "includes/article-form.php"?>

<?php require "includes/footer.php"?>