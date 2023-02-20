<?php
require "common.php";
$title = 'Task list';

ob_start();
require 'nav.php';
?>
<?php
    if(isset($error_message)){
        echo "<p class='message_error'>$error_message</p>";
    }
    if(isset($confirm_message)){
        echo "<p class='message_ok'>$confirm_message</p>";
    }
?>
<div class="container">
<a href="/~e2101563/proman/controllers/tasks_csv.php"><button class="buttons" value="csv">Export tasks to excel</button></a>
    <h1><?php echo $title . " (" . $tasksCount . ")" ?></h1>
    <!-- if there´s not yet data -->
    <?php if($tasksCount == 0) {?>
        <div>
            <p>You have not yet added any tasks</p>
            <p><a href='../controllers/task.php'>Add task</a></p>
        </div>
    <?php }?>
    <ul>
        <?php foreach ($tasksWithProjecs as $taskWithPr): ?>
            <li>      
        <a href="../controllers/task.php?id=<?php echo $taskWithPr['Task_id'];?>">
                Title: <?php echo $taskWithPr["taskName"];?>,
                Date: <?php echo $taskWithPr["TaskDate"]; ?>,
                Project: <?php echo $taskWithPr["projectName"]; ?>
        </a> 
        <br>
        <form method="post">  
                <input type="hidden" value="<?php echo $taskWithPr['Task_id'];?>" name="delete">
                <input type="submit" value="Delete: <?php echo $taskWithPr["taskName"];?>" class="delete">
        </form>
            </li>
            <?php endforeach ?>
    </ul>
</div>
<?php
$content = ob_get_clean();
include 'layout.php'
?>