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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if($article->delete($conn)){
            Url::redirect("/CMS/admin/index.php");
    }
}
?>

<?php require "../includes/header.php";?>

<h2>Delete Article</h2>

<form method="POST">
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="article.php?id=<?=$article->id;?>">Cancel</a>
</form>
<?php require "../includes/footer.php";?>
