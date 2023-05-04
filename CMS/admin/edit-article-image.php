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

        if($_FILES['file']['size'] > 1000000){
            throw new Exception('File is too large');
        }

        $mim_types = ['image/gif', 'image/png', 'image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if( ! in_array($mime_type, $mim_types)){
            throw new Exception('Not a supported file type');
        }

        $pathinfo = pathinfo($_FILES['file']['name']);

        $base = $pathinfo['filename'];

        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        $filename = $base . "." . $pathinfo['extension'];

        $destination = __DIR__ . "/uploads/$filename";

        $i = 1;

        while (file_exists($destination)){
            $filename = $base . "-$i." . $pathinfo['extension'];
            $destination = __DIR__ . "/uploads/$filename";
            $i++;
        }

        if(move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
            echo "File uploaded successfully";
        }else{
            throw new Exception("File failed to upload");
        }

    }catch(Exception $e){
        echo $e->getMessage();
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