<?php

function connectToDB() {
    // backend code goes before html tag
    // connect to database here
    // 1: database info
    $host = "127.0.0.1";
    $database_name = "simple_cms";
    $database_user = "root";
    $database_password = "";

    // 2: connect PHP with the MySQL database
    // PDO (PHP Database Object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name", //host and db name
        $database_user, //user
        $database_password //password
    );

    return $database;
};

function getUserByEmail($email){

    $database = connectToDB();

     // 4.25: sql
     $sql = "SELECT * FROM users where email = :email";

     // 4.5: prepare
     $query = $database->prepare($sql);

     // 4.75: execute
     $query->execute(["email" => $email]);

     // 5: fetch
     $user = $query->fetch();

     return $user;

}

function isUserLoggedIn() {
    return isset($_SESSION['user']['name']);
}

?>