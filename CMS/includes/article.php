<?php 

/**
 * Get the article record based on the ID
 *
 * @param object $conn Connection to the database
 * @param integer $id the article ID
 * @param string $columns Optional list of columns for the select, defaults to *
 * 
 * @return mixed An associative array containing the article with that ID, or null if not found 
 */
function getArticle($conn, $id, $columns = '*'){
    $sql = "SELECT $columns
            FROM article
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if($stmt === false){
        echo mysqli_error($conn);
    }else{
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * Validate the article properties
 * 
 * @param string $title Title, required
 * @param string $content Content, required
 * 
 * @return array An array of validation error messages
 */

function validateArticle($title, $content){
    
    $errors = [];

        if($title == ''){
            $errors[] = "Title is required";
        }
        if($content == ''){
            $errors[] = "Content is required";
        }
        

    return $errors;
}
