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

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    var_dump($_FILES['file']);

    try {
        if(empty($_FILES)){
            throw new Exception('Invalid Upload');
        }
    }
        switch($_FILES['file']['error']){
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uplaoaded');
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('File is too large (from server settings)');
            default:
                throw new Exception('An error occurred');
        } 


}
?>

<?php require "../includes/header.php"?>

<a href="index.php">All Articles</a>

<h2>Edit Article Image</h2>

<form method="POST" enctype="multipart/form-data">
    <div>
        <label for="file">Image File</label>
        <input type="file" name="file" id="file">
    </div>
    <button> Upload</button>
</form>

<?php require "../includes/footer.php"?>