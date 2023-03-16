<?php

$is_invalid = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $dbconn = require __DIR__ . "/db.php";
    
    $sql = sprintf("SELECT * FROM table1_tb
                    WHERE email = '%s'",
                   $dbconn->real_escape_string($_POST["email-login"]));
    
    $result = $dbconn->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password-login"], $user["passwords"])) {
            
            session_start();
            $_SESSION["user_id"] = $user["username"];
            header("Location: user_login.php");

            exit;
        }
    }
    
    $is_invalid = true;
}

