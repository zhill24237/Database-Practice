<?php 

require "includes/database.php";

$conn = getDB();

$sql = "SELECT *
        FROM article
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if($results === false){
    echo mysqli_error($conn);
}else{
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<?php require "includes/header.php"?>     

<a href="new-article.php">New Article</a>

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
        