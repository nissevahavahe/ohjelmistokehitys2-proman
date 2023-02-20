<?php
require_once "../model/model.php";
require "common.php";
require "upload.php";
$projects = get_all_projects();
$images;
$task_id;
$task_title;
$date;
$time;
$project_id;

$maxid = max_task_id();
if(isset($_GET['id'])){
    list($task_id,$task_title,$date,$time,$project_id) = get_task($_GET['id']);
    $images = get_images($_GET['id']);
    $comments = get_comments($_GET['id']);
}

if (isset($_POST['submit'])) {
    $id = null;
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }
    $title = escape(trim($_POST['title']));
    $date = escape($_POST['date']);
    $time = escape($_POST['time']);
    $project = escape($_POST['projects']);
    //$incomingfile = escape($_POST['task_upload']);

    if (empty($title) || empty($time) || empty($date) || empty($project)) {

        $error_message = "Title or category empty";

    } else {


        if (titleExists("tasks", $task_title) && $id == null) {
            $error_message = "I'm sorry, but looks like \"" . $title . "\" already exists";

        } else {
            if(add_task($title,$date,$time,$project,$id)){
                header('Refresh:4; url=tasks_list.php');    
                if(!empty($id)){
                    $confirm_message = escape($title) . ' updated successfully';
                    if(isset($_POST['deleteimg'])){
                        delete_img($_POST['deleteimg']);
                    }
                } else {
                    $confirm_message = escape($title) . ' added successfully';
                }
            } else {
                $error_message = "There's something wrong!";
            }
        }
    }
    if(isset($_POST['task_upload'])){
        $types = [
            'image/png' => 'png',
            'image/jpeg' => 'jpg'
        ];
        $fileTitle = $_FILES['task_upload']['name'];
        $filepath = $_FILES['task_upload']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);
        if(!empty($id)){
            $imgTaskId=$id;
        }else {
            $imgTaskId = $maxid;
        }
            fileEmpty($fileSize);
            fileLarge($fileSize);
            fileTypeCheck($types,$filetype);
            $filename = basename($filepath);
            $extension = $types[$filetype];
            $dir = '/u/g/e2101563/public_html/proman/data/imports';
            $newFilepath = $dir . "/" . $filename . "." . $extension;
            $dbFile = $filename . "." . $extension;
            if(!copy($filepath, $newFilepath)){
                die("Can't move file");
            }
            add_image($dbFile,$imgTaskId,$fileTitle);
    }
    if(isset($_POST['commentinput'])){
        try 
        {
            add_task_comment($_POST['commentinput'],$_POST['id']);
        } 
        catch (Exception $e)
        {
            echo "Error with saving comment";
        }
    }
}



require "../views/task.php";



?>