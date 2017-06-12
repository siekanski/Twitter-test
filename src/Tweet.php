<?php

class Tweet {
    //Static REPOSITORY methods:
    public static function getAllTweets(mysqli $conn, $user_id) {
        $sql = "SELECT * FROM Posts WHERE user_id=$user_id ORDER BY creation_date DESC";
        $toReturn = [];
        $result = $conn->query($sql);
        if($result != false) {
            foreach ($result as $row) {
                $tweet = new Tweet();
                $tweet->id = $row['id'];
                $tweet->user_id = $row['user_id'];
                $tweet->postText = $row['post_text'];
                $toReturn[] = $tweet;
            }
        }
        return $toReturn;
    }
    private $id;
    private $user_id;
    private $postText;
    private $date;
    public function __construct() {
        $this->id = -1;
        $this->user_id = null;
        $this->postText = "";
        $this->date = null;
    }
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->user_id;
    }
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
    public function getpostText() {
        return $this->postText;
    }
    public function setText($text) {
        $this->postText = $text;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function saveTweetToDB(mysqli $conn) {
        if($this->id === -1) {
            //insert row to DB
            $sql = "INSERT INTO Posts (user_id, post_text, creation_date) VALUES ('{$this->user_id}', '{$this->postText}', '{$this->date}' )";
            $result = $conn->query($sql);
            if($result == TRUE) {
                $this->id = $conn->insert_id;
                return true;
            }
            return false;
        } else {
            $sql = "UPDATE Posts SET post_text = '{$this->postText}' WHERE id={$this->id}";
            $result = $conn->query($sql);
            return $result;
        }
    }
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM Posts WHERE id=$id";
        $result = $conn->query($sql);
        if($result != false) {
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->postText = $row['post_text'];
                $this->user_id = $row['user_id'];
                $this->date = $row['creation_date'];
                return true;
            }
        }
    }
    public function getAllComments(mysqli $conn) {
        $comments = Comment::getAllComments($conn, $this->getId());
        return $comments;
    }
    public function showTweet() {
        $tweetText = $this->getpostText();
        return $tweetText;
    }
}

