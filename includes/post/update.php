<?php
    $database = connectToDB();

    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $post_id = $_POST["post_id"];

    if ( empty($title) || empty($desc) || empty($content) || empty($status) ){
        $_SESSION["error"] = "All fields required.";
    } else {

        $sql = "UPDATE posts SET title = :title, shortdesc = :desc, content = :content, status = :status WHERE post_id = :id";
        
        $query = $database->prepare($sql);
        
        $query->execute(["title" => $title, "desc" => $desc, "content" => $content, "status" => $status, "id" => $post_id]);
        
        $_SESSION["success"] = "Information updated successfully.";
        header("Location: /posts/manage");  
        exit;
    }

    header("Location: /posts/edit?id=$post_id");  
    exit;
?>