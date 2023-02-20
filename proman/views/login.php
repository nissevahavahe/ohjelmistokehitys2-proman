<?php
require "common.php";
$title = 'Login';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Xanh+Mono:ital@1&display=swap" rel="stylesheet">
    <title><?php echo $title ?></title>
</head>
<body>
    <div class="container">
    <div class="login">
    <form method="post">
        <div>
            <label for="username">
                Username:
            </label>
            <input type="text" name="username" id="username" class="basic-text">
        </div>
        <div>
            <label for="password">
                Password:
            </label>
            <input type="password" name="password" id="password" class="basic-text">
        </div>
        <div>
            <button type="submit" class="buttons">Submit</button>
        </div>
    </form>
    </div>
    </div>
</body>
</html>