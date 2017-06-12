<?php

class Message {
    //Static REPOSITORY methods:
    public static function getAllMessages(mysqli $conn, $sender_receiver, $user_id) {
        $sql = "SELECT * FROM Messages WHERE $sender_receiver = $user_id ORDER BY date DESC";
        $toReturn = [];
        $result = $conn->query($sql);
        if($result != false) {
            foreach ($result as $row) {
                $message = new Message();
                $message->id = $row['id'];
                $message->sender_id = $row['sender_id'];
                $message->receiver_id = $row['receiver_id'];
                $message->message_text = $row['message_text'];
                $message->is_read = $row['is_read'];
                $message->date = $row['date'];
                $toReturn[] = $message;
            }
        }
        return $toReturn;
    }
    public static function getNewMessages(mysqli $conn, $receiver_id) {
        $sql = "SELECT * FROM Messages WHERE receiver_id = '{$receiver_id}' AND is_read = 1";
        $result = $conn->query($sql);
        $toReturn = 0;
        foreach($result as $item) {
            $toReturn++;
        }
        return $toReturn;
    }
    
    private $id;
    private $sender_id;
    private $receiver_id;
    private $message_text;
    private $is_read;
    private $date;
    
    public function __construct() {
        $this->id = -1;
        $this->sender_id = null;
        $this->receiver_id = null;
        $this->message_text = null;
        $this->is_read = 1;
        $this->date = null;
    }
    
    function getId() {
        return $this->id;
    }

    function getSender_id() {
        return $this->sender_id;
    }

    function getReceiver_id() {
        return $this->receiver_id;
    }

    function getMessage_text() {
        return $this->message_text;
    }

    function getIs_read() {
        return $this->is_read;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSender_id($sender_id) {
        $this->sender_id = $sender_id;
    }

    function setReceiver_id($receiver_id) {
        $this->receiver_id = $receiver_id;
    }

    function setMessage_text($message_text) {
        $this->message_text = $message_text;
    }

    function setIs_read($is_read) {
        $this->is_read = $is_read;
    }

    function setDate($date) {
        $this->date = $date;
    }
    
    public function saveMessageToDB(mysqli $conn) {
        if($this->id === -1) {
            //insert row to DB
            $sql = "INSERT INTO Messages (sender_id, receiver_id, message_text, is_read, date) VALUES ('{$this->sender_id}', '{$this->receiver_id}', '{$this->message_text}', '{$this->is_read}', '{$this->date}' )";
            $result = $conn->query($sql);
            if($result == TRUE) {
                $this->id = $conn->insert_id;
                return true;
            }
            } else {
            $sql = "UPDATE Messages SET is_read = '{$this->is_read}' WHERE id='{$this->id}'";
            $result = $conn->query($sql);
            return $result;
        }
            return false;
        }
    public function loadMessageDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM Messages WHERE id=$id";
        $result = $conn->query($sql);
        if($result != false) {
            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->sender_id = $row['sender_id'];
                $this->receiver_id = $row['receiver_id'];
                $this->message_text = $row['message_text'];
                $this->is_read = $row['is_read'];
                $this->date = $row['date'];
                return true;
            }
        }
    }
    public function checkMessage() {
        if($this->is_read == 1) {
            return '<span class="label label-success">NEW</span>';
        } else {
            return '<span class="label label-warning">READ</span>';
        }
    }


    
    
}

