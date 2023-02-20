<?php
// model/model.php
require "connection.php";

$connection = db_connect();

function get_all_projects()
{
    try {
        global $connection;

        $sql = 'SELECT * FROM projects ORDER BY id';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
function get_all_projects_counts()
{
try {
    global $connection;

    $sql = 'SELECT COUNT(id) as nb FROM projects';
    $statement = $connection->query($sql)->fetch();
    
    $projectCount = $statement['nb'];

    return $projectCount;
} catch (PDOException $err){
    echo $sql. "<br>" . $err->getMessage();
    exit;
}
}
function get_project($id)
{
    try {
        global $connection;

        $sql = 'SELECT * FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1,$id,PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    }catch (PDOException $exception){
        echo $sql. "<br>" . $exception->getMessage();
        exit;
    }
}
function get_task($id)
{
    try {
        global $connection;

        $sql = 'SELECT * FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1,$id,PDO::PARAM_INT);
        $task->execute();

        return $task->fetch();
    }catch (PDOException $exception){
        echo $sql. "<br>" . $exception->getMessage();
        exit;
    }
}
function get_all_tasks() 
{
    try {
        global $connection;
        $sql ='SELECT * FROM tasks ORDER BY title';
        $tasks = $connection->query($sql);
        return $tasks;
    } catch (PDOException $err){
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
function get_all_tasks_counts()
{
try {
    global $connection;

    $sql = 'SELECT COUNT(id) as taskscount FROM tasks';
    $statement = $connection->query($sql)->fetch();
    
    $tasksCount = $statement['taskscount'];
    return $tasksCount;
} catch (PDOException $err){
    echo $sql. "<br>" . $err->getMessage();
    exit;
}
}
function get_all_tasks_with_projects(){
    try {
        global $connection;
        $sql ='SELECT ta.id AS Task_id, ta.Title AS taskName, DATE_FORMAT(ta.date_task,"%d.%m.%Y") AS TaskDate, pr.title as projectName FROM tasks ta LEFT JOIN projects pr ON ta.project_id=pr.id ';
        $tasks = $connection->query($sql);
        return $tasks;
    } catch (PDOException $err){
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function add_project($title,$category,$id){
    
    try{
        global $connection;

        if($id){
        $sql = 'UPDATE projects SET title = ?, category = ? WHERE id = ?';
        } else {
        $sql = 'INSERT INTO projects(title,category) VALUES(?,?)';
        }
        $statement = $connection -> prepare($sql);
        $new_project = array($title,$category);

        if($id){
            $new_project = array($title,$category,$id);
        }
        
        $affectedLines = $statement->execute($new_project);

        return $affectedLines;
    } catch (PDOException $err){
        echo $sql. "<br>". $err->getMessage();
        exit;
    }
}
function add_task($title,$date_task,$time_task,$project_id,$id){
    
    try{
        global $connection;
        if($id){
        $sql = 'UPDATE tasks SET title = ?, date_task = ? ,time_task = ? ,project_id = ? WHERE id = ?';   
        }else {
        $sql = 'INSERT INTO tasks(title,date_task,time_task,project_id) VALUES(?,?,?,?)';
        }
        $statement = $connection -> prepare($sql);
        $new_task = array($title,$date_task,$time_task,$project_id);
        
        if($id){
            $new_task = array($title,$date_task,$time_task,$project_id,$id);
        }

        $affectedLines = $statement->execute($new_task);

        return $affectedLines;
    } catch (PDOException $err){
        echo $sql. "<br>". $err->getMessage();
        exit;
    }
}

function titleExists($table,$title){
    try {
        global $connection;

        $sql = 'SELECT title FROM ' . $table . ' WHERE title = ? ';
        $statement = $connection -> prepare($sql);
        $statement->execute(array($title));

        if($statement->rowCount() > 0){
            return true;
        } 
    } catch(PDOException $exception){
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}
function delete_task($id){
        try
        {
            global $connection;

            $sql = 'DELETE FROM tasks WHERE id = ?';
            $task = $connection->prepare($sql);
            $task -> bindValue(1,$id,PDO::PARAM_INT);
            $task -> execute();

            return true;
        } catch(PDOException $exception){
            echo $sql . "<br>" . $exception->getMessage();
            exit;
        }
}
function delete_project($id){
    try
    {
        global $connection;

        $sql = 'DELETE FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project -> bindValue(1,$id,PDO::PARAM_INT);
        $project -> execute();
        return true;
    } catch(PDOException $exception){
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}
function project_columns(){
    try
    {
        global $connection;

        $sql = "SELECT `COLUMN_NAME` AS Col FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='e2101563_proman' AND `TABLE_NAME`='projects'";
        $project_columns = $connection->prepare($sql);
        $project_columns -> execute();
        return $project_columns;
    } catch(PDOException $exception){
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }    
}
function task_columns(){
    try
    {
        global $connection;

        $sql = "SELECT `COLUMN_NAME` AS Col FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='e2101563_proman' AND `TABLE_NAME`='task_csv'";
        $task_columns = $connection->prepare($sql);
        $task_columns -> execute();
        return $task_columns;
    } catch(PDOException $exception){
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }    
}
function add_image($filepath,$taskid,$title){
    try{
        global $connection;{
        $sql = 'INSERT INTO img(filepath,taskid,title) VALUES(?,?,?)';

        $statement = $connection -> prepare($sql);
        $new_img = array($filepath,$taskid,$title);

        $affectedLines = $statement->execute($new_img);
        }
        return $affectedLines;
    } catch (PDOException $err){
        echo $sql. "<br>". $err->getMessage();
        exit;
    }
}
function get_images($id){
    try {
        global $connection;

        $sql = 'SELECT imgid,filepath,taskid FROM img WHERE taskid = ?';
        $img = $connection->prepare($sql);
        $img->bindValue(1,$id,PDO::PARAM_INT);
        $img->execute();

        return $img;
    }catch (PDOException $exception){
        echo $sql. "<br>" . $exception->getMessage();
        exit;
    }
}

// Parempi tehdä lastInsertId funktiolla.
function max_task_id(){
    try {
        global $connection;
        $sql = 'SELECT MAX(id)+1 as nid FROM tasks';
        $statement = $connection->query($sql)->fetch();
        
        $futureid= $statement['nid'];
    
        return $futureid;
    } catch (PDOException $err){
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
function delete_img($id){
    try
    {
        global $connection;

        $sql = 'DELETE FROM img WHERE imgid = ?';
        $img = $connection->prepare($sql);
        $img -> bindValue(1,$id,PDO::PARAM_INT);
        $img -> execute();

        return true;
    } catch(PDOException $exception){
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}
function filter_projects($search){
    try {
        global $connection;
        $sql = 'SELECT * FROM projects WHERE title LIKE ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1,$search ,PDO:: PARAM_STR);
        $project->execute();

        return $project;
    }catch (PDOException $exception){
        echo $sql. "<br>" . $exception->getMessage();
        exit;
    } 
}
function get_filtered_projects_counts($search)
{
try {
    global $connection;

    $sql = 'SELECT COUNT(id) as nb FROM projects WHERE title LIKE ?';
    $project = $connection->prepare($sql);
    $project->bindValue(1,$search ,PDO:: PARAM_STR);
    $project->execute();
    return $project->fetch();
} catch (PDOException $err){
    echo $sql. "<br>" . $err->getMessage();
    exit;
}
}
function add_task_comment($comment,$taskid){
    try{
        global $connection;{
        $sql = 'INSERT INTO task_comments(comment,taskid) VALUES(?,?)';

        $statement = $connection -> prepare($sql);
        $new_comment = array($comment,$taskid);

        $affectedLines = $statement->execute($new_comment);
        }
        return $affectedLines;
    } catch (PDOException $err){
        echo $sql. "<br>". $err->getMessage();
        exit;
    }
}

function get_comments($id){
    try {
        global $connection;

        $sql = 'SELECT * FROM task_comments WHERE archived=0 AND taskid=?';
        $img = $connection->prepare($sql);
        $img->bindValue(1,$id,PDO::PARAM_INT);
        $img->execute();

        return $img;
    }catch (PDOException $exception){
        echo $sql. "<br>" . $exception->getMessage();
        exit;
    }
}
function archive_comment($taskid,$commentid){
    try{
        global $connection;{
        $sql = 'UPDATE task_comments SET archived=1  WHERE taskid= ? AND commentId= ?';

        $statement = $connection -> prepare($sql);
        $new_comment = array($taskid,$commentid);

        $affectedLines = $statement->execute($new_comment);
        }
        return $affectedLines;
    } catch (PDOException $err){
        echo $sql. "<br>". $err->getMessage();
        exit;
    }
}
function table_report_data()
{
    try {
        global $connection;

        $sql = 'SELECT pr.title,pr.category, COUNT(ta.title) as taskcount FROM projects pr LEFT JOIN tasks ta ON pr.id=ta.project_id GROUP BY pr.Title';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
function barchart_report_data()
{
    try {
        global $connection;

        $sql = "SELECT pr.title as title, COUNT(ta.title) as taskcount FROM projects pr LEFT JOIN tasks ta ON pr.id=ta.project_id GROUP BY pr.Title";
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
?>