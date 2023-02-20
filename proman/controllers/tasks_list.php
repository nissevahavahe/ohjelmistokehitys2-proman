<?php
// controllers/project_list.php
require_once "../model/model.php";

if(isset($_POST['delete'])){
    if(delete_task($_POST['delete'])){
        header('location: tasks_list.php?confirm_message=Task+deleted');
        exit;
    }else {
        header('location: tasks_list.php?error_message=Couldn\'t+delete+the+task');
        exit;
    }
}
 
if(isset($_GET['error_message'])){
    $error_message = $_GET['error_message'];
}else if (isset($_GET['confirm_message'])){
    $confirm_message = $_GET['confirm_message'];
}

$tasks = get_all_tasks();
$tasksWithProjecs = get_all_tasks_with_projects();
$tasksCount = get_all_tasks_counts();
require "../views/tasks_list.php";
?>
