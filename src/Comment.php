<?php

class Comment {
    
    public static function getAllComments(mysqli $conn, $post_id){
        $sql = "SELECT * FROM Comments WHERE post_id=$post_id ORDER BY creation date DESC";
        
        $toReturn = [];
        
        $result = $conn->query($sql);
        if($result !=false){
            foreach ($result as $row){
                $comment = new Comment();
                $comment->id = $row['id'];
                $comment->user_id = $row['user_id'];
                $comment->post_id = $row['post_id'];
                $comment->text = $row['comment_text'];
                $comment->date = $row['creation_date'];
                $toReturn[] = $comment;
            }
        }
        
        return $toReturn;
    }
    
    private $id;
    private $user_id;
    private $post_id;
    private $text;
    private $date;
    
    public function __construct() {
        $this->id = -1;
        $this->post_id = null;
        $this->user_id = null;
        $this->text = null;
        $this->date = null;
    }
    function getId() {
        return $this->id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getPost_id() {
        return $this->post_id;
    }

    function getText() {
        return $this->text;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setDate($date) {
        $this->date = $date;
    }
    
    public function loadFromDB(){
        
        $sql = "SELECT * FROM Comments WHERE post_id=$id";
        $result = $conn->query($sql);
        if($result != false) {
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->user_id = $row['user_id'];
                $this->post_id = $row['post_id'];
                $this->date = $row['creation_date'];
                $this->text = $row['comment_text'];
                return true;
            }
        }
    }
    
    public function saveCommentToDB (mysqli $conn) {
        if($this->id == -1) {
            //insert row to DB
            $sql = "INSERT INTO Comments (post_id, user_id, comment_text, creation_date) VALUES ('{$this->post_id}', '{$this->user_id}', '{$this->text}', '{$this->date}')";
            $result = $conn->query($sql);
            if($result == TRUE) {
                $this->id = $conn->insert_id;
                return true;
            }
            return false;
        } else {
            $sql = "UPDATE Comments SET comment_text = '{$this->text}' WHERE id={$this->id}";
            $result = $conn->query($sql);
            return $result;
        }
    }
    
    public function showComment() {
        $commentText = $this->getText();
        return $commentText;
    }
}


    
    


