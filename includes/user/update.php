<?php
    $database = connectToDB();

    $name = $_POST["name"];
    $id = $_POST["id"];
    $email = $_POST["email"];
    $role = $_POST["role"];

    if (empty($name)||empty($email)||empty($role)){
        $_SESSION["error"] = 'All fields required.';
    } else {

        $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
        
        $query = $database->prepare($sql);
        
        $query->execute(["name" => $name, "email" => $email, "role" => $role, "id" => $id]);
        
        $_SESSION["success"] = "Information updated successfully.";
        header("Location: /users/manage");  
        exit;
    }

    header("Location: /users/edit");  
    exit;
?>