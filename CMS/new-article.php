<?php

require "includes/database.php";
require 'includes/article.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

if(!isLoggedIn()){
    die("unauthorised");
}

$errors = [];
$title = '';
$content = '';
$published_at = '';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    
    $title = $_POST['title'];
    $content = $_POST['content'];


    $errors = validateArticle($title, $content);

    if(empty($errors)){

        $conn = getDB();


        $sql = "INSERT INTO article (title, content, published_at)
                VALUES (?, ?, 
                NOW())";

        
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt === false){
            echo mysqli_error($conn);
        }else{
            
            mysqli_stmt_bind_param($stmt, "ss", $title, $content);
            if(mysqli_stmt_execute($stmt)){
                $id = mysqli_insert_id($conn);
                redirect("/CMS/article.php?id=$id");
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