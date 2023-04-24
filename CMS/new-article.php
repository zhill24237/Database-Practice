<?php

require "includes/database.php";
require 'includes/article.php';

$errors = [];
$title = '';
$content = '';
$published_at = '';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $title = $_POST['title'];

    $content = $_POST['content'];

    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if(empty($errors)){

        $conn = getDB();

        $sql = "INSERT INTO article (title, content, published_at)
                VALUES (?, ?, ?)";

        
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt === false){
            echo mysqli_error($conn);
        }else{

            if($published_at == ''){
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            if(mysqli_stmt_execute($stmt)){
                $id = mysqli_insert_id($conn);
                header("Location: article.php?id=$id");
                exit;
            }else{
                echo mysqli_stmt_error($stmt);
            }

            
        }
    }
}
?>



<?php require "includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>New Article</h2>

<?php require "includes/article-form.php"?>

<?php require "includes/footer.php"?>