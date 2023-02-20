<?php 
require 'connection.php';
$to = "e2101563@edu.vamk.fi";
$subject = "Reminder from your favorite project management app";
$headers = "From : proman@reminderbot.proman";
$connection = db_connect();
function getTasks(){
    try {
        global $connection;
        $sql ='SELECT * FROM tasks  WHERE date_task < CURDATE() OR date_task < INTERVAL 4 DAY + CURDATE() ORDER BY title';
        $tasks = $connection->query($sql);
        return $tasks;
    } catch (PDOException $err){
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
function sendEmail($to,$subject,$txt,$headers){
    if (($to == "tul@vamk.fi")|| ($to == "tero.ulvinen@vamk.fi")){
    echo "error";
}else {    
    if (mail($to,$subject,$txt,$headers)) {
        return true;
    } else {
        return false;
    }
}}
$tasks_alert = getTasks();

foreach($tasks_alert as $task){
    $txt .= "Hello your " . $task['title'] . " is late. \n Here is a link to the task: https://www.cc.puv.fi/~e2101563/proman/controllers/task.php?id=" . $task['id'] . " \n"; 
}

if(isset($tasks_alert)){
    sendEmail($to,$subject,$txt,$headers);
}
?>