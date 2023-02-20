<?php
require_once "../model/model.php";
$filename = '../data/exports/projects_'. date("d_m_Y_h_i_s") .'.csv';
$projects = get_all_projects();
$columns = project_columns();
$data = "";
foreach($columns as $column){
    $data .= strtoupper($column['Col']) . ";";
}
$data .= "\r";
foreach($projects as $project){
$data .= $project['id'] . ";" . $project['title'] . ";" . $project['category'] . ";" . "\r";
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