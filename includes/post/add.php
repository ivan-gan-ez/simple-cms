<?php

$database = connectToDB();

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$content = isset($_POST["content"]) ? $_POST["content"] : "";
$user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : "";
$image = isset($_FILES['fileToUpload']) ? $_FILES['fileToUpload'] : "";


if ( empty($title) || empty($desc) || empty($content) ) {
    $_SESSION["error"] = 'All fields required.';
    header("Location: /posts/add");  
    exit;
};

if ( !empty($image) ) {

    // tell PHP where upload folder is
    $target_folder = "uploads/";
    // add image to name to upload folder path
    $target_path = $target_folder.date("YmdHisv").basename($image['name']);
    // move file to uploads folder
    move_uploaded_file( $image["tmp_name"], $target_path );

};

// 5.333: recipe (sql command)
$sql = "INSERT INTO posts (`title`, `shortdesc`, `content`, `image`, `user_id`) VALUES (:title, :desc, :content, :image, :user_id)";

// 5.666: prepare material (prepare sql query)
$query = $database->prepare($sql);

// 6: cook it (execute the sql query)
 $query->execute(["title" => $title, "desc" => $desc, "content" => $content, "image" => $target_path, "user_id" => $user_id]);
     
// 7: set success message
$_SESSION["success"] = "Post created successfully.";

// 8: redirect user
header("Location: /posts/manage");  
exit;

?>