<?php 

/**
 * Database
 * 
 * A connection to the database
 */

class Database{

    /**
     * Get the databse connection
     * 
     * @return PDO object Connection to the database server
     */
    public function getConn(){
        $db_host = "localhost";
        $db_name = "cms";
        $db_user = "cms_admin";
        $db_pass = "v2p!BwiLRRfXdoji";

        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
        
        try{
            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db; 
        } catch(PDOException $e){
           echo $e->getMessage();
           exit;
        }

        
    }
}