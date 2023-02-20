<?php
/*
WARNING: This installer script will overwrite the database!
*/
require "../model/config.php";

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username,$password,$options);
    
    $sql_structure = file_get_contents("structure.sql");
    $sql_content = file_get_contents("content.sql");

    $connection->exec($sql_structure);
    $connection->exec($sql_content);

    echo "<p> Database created and populated successfully. <br><a href='../'>home</a></p>";
} catch (PDOException $error){
    echo "<br> SQL ERROR:" . $error->getMessage();
}
?>