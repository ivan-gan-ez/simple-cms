<?php

$database = connectToDB();

$name = isset($_POST["name"]) ? $_POST["name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$confirm_password = isset($_POST["confirm-password"]) ? $_POST["confirm-password"] : "";
$role = isset($_POST["role"]) ? $_POST["role"] : "";

$user = getUserByEmail($email);

if ( $user ) {
    $_SESSION["error"] = "A user with this email already exists.";
} else {
if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role) ) {
    $_SESSION["error"] = 'All fields required.';
} else if ( $password !== $confirm_password ){
    $_SESSION["error"] = 'Your passwords do not match.';
} else {

     // 5.333: recipe (sql command)
     $sql = "INSERT INTO users (`name`, `email`, `password`, `role`) VALUES (:name, :email, :password, :role)";

     // 5.666: prepare material (prepare sql query)
     $query = $database->prepare($sql);

     // 6: cook it (execute the sql query)
     $query->execute(["name" => $name, "email" => $email, "password" => password_hash($password, PASSWORD_DEFAULT), "role" => $role]);
     
     // 7: set success message
     $_SESSION["success"] = "Account created successfully.";

     // 8: redirect user
    header("Location: /users/manage");  
    exit;

};
}
header("Location: /users/add");  
exit;

?>