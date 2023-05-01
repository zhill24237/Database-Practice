<?php

/**
 * Article
 * 
 * A place of writing for publication
 */
class Article{

    /**
     * Unique identifier
     * @var integer
     */
    public $id;
    /**
     * The article title
     * @var string
     */
    public $title;
    /**
     * The article content
     * @var string
     */
    public $content;
    public $errors = [];
    /**
     * Get all the articles
     * 
     * @param object $conn Connection to the database
     * 
     * @return array An associative array of all article records
     */
    public static function getAll($conn){
        $sql = "SELECT *
        FROM article
        ORDER BY published_at;";

    $results = $conn->query($sql);

    return $results->fetchAll(PDO::FETCH_ASSOC);
    }

/**
 * Get the article record based on the ID
 *
 * @param object $conn Connection to the database
 * @param integer $id the article ID
 * @param string $columns Optional list of columns for the select, defaults to *
 * 
 * @return mixed An object containing the article with that ID, or null if not found 
 */
    public static function getByID($conn, $id, $columns = '*'){
        $sql = "SELECT $columns
                FROM article
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

            if($stmt->execute()){
                return $stmt->fetch();
            }
        
    }

/**
 * Update the article with its current property values
 * 
 * @param object $conn Connection to the databse
 * 
 * @return boolean True of the upadte was succesful, False otherwise
 */
    public function update($conn){
        if($this->validate()){
            $sql = "UPDATE article
                    SET title = :title,
                        content = :content
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            return $stmt->execute();
        }else{
            return false;
        }
            

    }


    /**
     * Validate the article properties
     * 
     * @param string $title Title, required
     * @param string $content Content, required
     * 
     * @return boolean If the errors array is empty or not
     */

    protected function validate(){
        
        

            if($this->title == ''){
                $this->errors[] = "Title is required";
            }
            if($this->content == ''){
                $this->errors[] = "Content is required";
            }
            

        return empty($this->errors);
    }

    /**
     * Delete the current article
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the delte was successful, false otherwise
     */
    public function delete($conn){
        $sql = "DELETE FROM article
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();

    }

/**
 * Insert a new article with its current property values
 * 
 * @param object $conn Connection to the databse
 * 
 * @return boolean True of the upadte was succesful, False otherwise
 */
    public function create($conn){
        if($this->validate()){
            $sql = "INSERT INTO article (title, content)
                    VALUES (:title, :content)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        } 
        
    }
}
