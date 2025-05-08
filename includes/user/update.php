<?php
    $database = connectToDB();

    $name = $_POST["name"];
    $id = $_POST["id"];
    $role = $_POST["role"];

    if (empty($name)||empty($role)){
        $_SESSION["error"] = "All fields required.";
    } else {

        $sql = "UPDATE users SET name = :name, role = :role WHERE id = :id";
        
        $query = $database->prepare($sql);
        
        $query->execute(["name" => $name, "role" => $role, "id" => $id]);
        
        $_SESSION["success"] = "Post updated successfully.";
        header("Location: /users/manage");  
        exit;
    }

    header("Location: /users/edit?id=$id");  
    exit;
?>