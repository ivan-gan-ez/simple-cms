<?php
    $database = connectToDB();

    // 3: get data from login page
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4: check for error
    if ( empty($email) || empty($password) ) {
        $_SESSION["error"] = 'All fields required.';
    } else {
        $user = getUserByEmail($email);

        // 6: check if user exists
        if ( $user ) {

            // 7: check if password matches
            if ( password_verify( $password, $user["password"] ) ){

                // 8: store user data in session
                $_SESSION["user"] = $user;

                // 9: redirect user back to main page
                unset($_SESSION["error"]);
                $_SESSION["success"] = "Welcome back, ".$user['name']."!";
                header("Location: /dashboard");
                exit;

            } else {
                $_SESSION["error"] = 'Incorrect password.';
            }
        } else {
            $_SESSION["error"] = 'Invalid email.';
        }
    };

    // 9: redirect user back to main page
    header("Location: /login");
    exit;
?>