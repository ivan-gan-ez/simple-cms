<?php

$database = connectToDB();

$user_id = $_POST["user_id"];

// Get data from database
// 2.333: recipe (sql command)
$sql = "DELETE FROM users WHERE id = :id";

// 2.666: prepare material (prepare sql query)
$query = $database->prepare($sql);

// 3: cook it (execute the sql query)
$query->execute(["id" => $user_id]);

// 4: redirect user
header("Location: /users/manage");  
exit;
?>

?>