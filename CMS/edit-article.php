<?php 

require "includes/database.php";
require "includes/article.php";
require "includes/url.php";

$conn = getDB();

if(isset($_GET['id'])){
    
    $article = getArticle($conn, $_GET['id']);

    if($article){
        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    }else{
        die("article not found");
    }
    

}else{
    
    die("id not supplied, article not found.");

}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $title = $_POST['title'];
    $content = $_POST['content'];

    $errors = validateArticle($title, $content);

    if(empty($errors)){

        $conn = getDB();

        $sql = "UPDATE article
                SET title = ?,
                    content = ?
                WHERE id = ?";

        
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt === false){
            echo mysqli_error($conn);
        }else{

            mysqli_stmt_bind_param($stmt, "ssi", $title, $content,$id);

            redirect("/CMS/article.php?id=$id");

            
        }
    }
}
?>

<?php require "includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>Edit Article</h2>

<?php require "includes/article-form.php"?>

<?php require "includes/footer.php"?>