<?php
require_once "../model/model.php";
function login($username, $password)
{
    $users = [
        'vamk' => '$2y$10$DxkKUr830tmTmI2rVcah.uWMS9Obf/LFBlzvzyXJaaNnnJ30FO/Qm'
    ];
    if (isset($users[$username])) {
        // The provided username is correct, now validate the password
        $expectedPasswordHash = $users[$username];

        if (password_verify($password, $expectedPasswordHash)) {
            session_start();
            /// Remember the username of the user who just logged in
            $_SESSION['authenticated_user'] = $username;

            // Redirect to /secrect.php
            header('Location: ../');
            exit;
        } else {
            return false;
        }
    }
}
if (isset($_POST['username'],$_POST['password'])) {
    if(!login($_POST['username'],$_POST['password'])){
        echo "Login failed, please try again";
    }
}



require "../views/login.php";
?>