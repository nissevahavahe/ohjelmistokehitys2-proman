<?php
require_once "../model/model.php";
$filename = '../data/exports/tasks_'. date("d_m_Y_h_i_s") .'.csv';
$tasks = get_all_tasks_with_projects();
$columns = task_columns();
$data = "";
foreach($columns as $column){
    $data .= strtoupper($column['Col']) . ";";
}

$data .= "\r";
foreach($tasks as $task){
$data .= $task['Task_id'] . ";" . $task['taskName'] . ";" . $task['TaskDate'] . ";" . $task['projectName'] ."\r";
}


    if(!$fp =  fopen($filename,'x')){
        echo "Error with writing the file";
        exit;
    }
    if(fwrite($fp,$data) === FALSE){
        echo "Cannot write to file ($filename)";
        exit;   
    }

    header("Location:". $filename);
    
    fclose($fp);


?>