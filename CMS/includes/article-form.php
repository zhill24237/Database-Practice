<?php if(!empty($errors)):?>
    <?php foreach ($errors as $error):?>
        <li><?= $error?></li>
    <?php endforeach;?>

<?php endif;?>

<form method="post">

    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article Title" value="<?=htmlspecialchars($title);?>"> 
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" rows="4" cols="40" id="content" placeholder="Article Content"><?=htmlspecialchars($content);?></textarea>
    </div>
    
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" value="<?=htmlspecialchars($published_at);?>">
    </div>

    <button>Save</button>

</form>