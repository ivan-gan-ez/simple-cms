<?php
    $database = connectToDB();

    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $post_id = $_POST["post_id"];
    $image = $_FILES["image"];

    if ( empty($title) || empty($desc) || empty($content) || empty($status) ){
        $_SESSION["error"] = "All fields required.";
        header("Location: /posts/edit?id=$post_id");  
        exit;
    };

    if ( !empty($image['name']) ) {

    // tell PHP where upload folder is
    $target_folder = "uploads/";
    // add image to name to upload folder path
    $target_path = $target_folder.date("YmdHisv").basename($image['name']);
    // move file to uploads folder
    move_uploaded_file( $image["tmp_name"], $target_path );

    $sql = "UPDATE posts SET title = :title, shortdesc = :desc, content = :content, status = :status, image = :image WHERE post_id = :id";
        
    $query = $database->prepare($sql);
        
    $query->execute(["title" => $title, "desc" => $desc, "content" => $content, "status" => $status, "image" => $target_path, "id" => $post_id]);
        
    $_SESSION["success"] = "Information updated successfully.";
    header("Location: /posts/manage");  
    exit;

    } else {

    $sql = "UPDATE posts SET title = :title, shortdesc = :desc, content = :content, status = :status WHERE post_id = :id";
        
    $query = $database->prepare($sql);
        
    $query->execute(["title" => $title, "desc" => $desc, "content" => $content, "status" => $status, "id" => $post_id]);
        
    $_SESSION["success"] = "Information updated successfully.";
    header("Location: /posts/manage");  
    exit;

    };

?>