<?php 

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);
?>

<?php require "../includes/header.php"?>     

<h2>Administration</h2>

<p><a href="new-article.php">New Article</a></p>

    <?php if(empty($articles)):?>
        <p>No articles found.</p>
    <?php else: ?>
    <table>
        <thead>
            <th>Title</th>
        </thead>
        <tbody>
        <?php foreach($articles as $articles): ?>
            <tr>
                <td>
                    <a href="article.php?id=<?= $articles['id'];?>"><?= htmlspecialchars($articles['title']);?></a>
                </td>
            </tr>
        <?php endforeach?>
        </tbody>
    </table>
    <?php require '../includes/pagination.php';?>
    <?php endif?>

<?php require "../includes/footer.php"?>
        