<?php 

require "includes/database.php";
require "includes/article.php";

$conn = getDB();

if(isset($_GET['id'])){
    
    $article = getArticle($conn, $_GET['id']);

}else{
    $article = null;
}



?>

<?php require "includes/header.php"?>

<a href="index.php">All Articles</a>

            <?php if($article === null):?>
                <p>No articles found.</p>
            <?php else: ?>
                <article>
                    <h2><?= $article['title'];?></h2>
                    <p><?= $article['content'];?></p>
                </article>
            <?php endif?>

<?php require "includes/footer.php"?>