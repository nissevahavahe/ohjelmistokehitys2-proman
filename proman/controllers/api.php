<?php
require_once "../model/model.php";
$projects = get_all_projects();
$tasks = get_all_tasks_with_projects();
$project_array = [];
$task_array = [];
foreach($projects as $project){
array_push($project_array, array('ID' => $project['id'], 'Title' => $project['title'], 'Category' => $project['category']));
}
foreach($tasks as $task){
array_push($task_array, array( 'ID' => $task['Task_id'], "Name" => $task['taskName'], "Date" => $task['TaskDate'], "Project"  => $task['projectName']));    
}
if(isset($_GET['projects'])){
echo json_encode($project_array);  
}
else if(isset($_GET['tasks'])){
echo json_encode($task_array);    
}
else {
    echo "Invalid call";
}
?>