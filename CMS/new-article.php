<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    require "includes/database.php";

    $sql = "INSERT INTO article (title, content, published_at)
            VALUES ('" . $_POST['title'] . "','"
                       . $_POST['content'] . "','"
                       . $_POST['published_at'] . "')";

    var_dump($sql);
    
    $results = mysqli_query($conn, $sql);

    if($results === false){
        echo mysqli_error($conn);
    }else{
        $id = mysqli_insert_id($conn);
    }
}

?>



<?php require "includes/header.php"?>

<h2>New Article</h2>

<form method="post">

    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article Title">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" rows="4" cols="40" id="content" placeholder="Article Content"></textarea>
    </div>
    
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at">
    </div>

    <button>Add</button>

</form>

<?php require "includes/footer.php"?>