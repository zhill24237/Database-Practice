<?php  

require 'includes/init.php';

$conn = require 'includes/db.php';

if(isset($_GET['id'])){
    
    $article = Article::getByID($conn, $_GET['id']);

}else{
    $article = null;
}



?>

<?php require "includes/header.php"?>

<a href="index.php">All Articles</a>

            <?php if($article):?>
                <article>
                    <h2><?= htmlspecialchars($article->title);?></h2>
                    <p><?= htmlspecialchars($article->content);?></p>
                </article>
            <?php else: ?>
                <p>Article Not Found.</p>
            <?php endif?>

<?php require "includes/footer.php"?>