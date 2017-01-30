<?php

$conn = new mysqli('localhost', 'root', 'coderslab', 'Twitter');
if ($conn->connect_error) {
    die("Połączenie nieudane. Bład: " . $conn->connect_error);
}
/*
    CREATE TABLE Users (
    id int(11) NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL UNIQUE,
    username varchar(255) NOT NULL,
    hashed_password varchar(60) NOT NULL,
    PRIMARY KEY(id)
    );    
    
    CREATE TABLE Comments (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    tweet_id int NOT NULL,
    creationDate date NOT NULL,
    comment varchar(140) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id)
    REFERENCES Users(id),
    FOREIGN KEY(tweet_id)
    REFERENCES Tweet(id) ON DELETE CASCADE
    );
    CREATE TABLE Tweet (
    id int NOT NULL AUTO_INCREMENT,
    user_Id int NOT NULL,
    text varchar(140) NOT NULL,
    creationDate DATE,
    PRIMARY KEY(id),
    FOREIGN KEY(user_Id)
    REFERENCES Users(id) ON DELETE CASCADE
    );
*/
