<?php 

require "classes/Database.php";
require 'classes/Article.php';
require 'includes/auth.php';

session_start();

$db = new Database();
$conn = $db->getConn();

$articles = Article::getAll($conn);
?>

<?php require "includes/header.php"?>     

<?php if(isLoggedIn()):?>
    <p>You are logged in. <a href="logout.php">Log Out</a></p>
    <p><a href="new-article.php">New Article</a></p>
<?php else:?>
    <p>You are logged out. <a href="login.php">Log In</a></p>
<?php endif; ?>


    <?php if(empty($articles)):?>
        <p>No articles found.</p>
    <?php else: ?>
    <ul>
        <?php foreach($articles as $articles): ?>
            <li>
                <article>
                    <h2><a href="article.php?id=<?= $articles['id'];?>"><?= htmlspecialchars($articles['title']);?></a></h2>
                    <p><?= htmlspecialchars($articles['content']);?></p>
                </article>
            </li>
        <?php endforeach?>
    </ul>
    <?php endif?>

<?php require "includes/footer.php"?>
        