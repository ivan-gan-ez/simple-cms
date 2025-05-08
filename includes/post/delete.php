<?php

$database = connectToDB();

$post_id = $_POST["post_id"];

// Get data from database
// 2.333: recipe (sql command)
$sql = "DELETE FROM posts WHERE post_id = :id";

// 2.666: prepare material (prepare sql query)
$query = $database->prepare($sql);

// 3: cook it (execute the sql query)
$query->execute(["id" => $post_id]);

// 4: redirect user
header("Location: /posts/manage");  
exit;
?>

?>