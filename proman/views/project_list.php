<?php
require "common.php";
$title = 'Project list';

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
<a href="/~e2101563/proman/controllers/project_csv.php"><button class="buttons" value="csv">Export projects to excel</button></a>
<form  method="post">
    <label for="search">Search project</label>
    <input type="text" name="search" id="search" class="basic-text">
    <br>
    <input type="submit" value="Search" name="searchsub" class="buttons">
</form>
    <?php if(isset($_POST['search'])){ ?>
        <h1><?php echo $title . " (" . $projectCount['nb'] . ")" ?></h1>
    <?php } else { ?>
    <h1><?php echo $title . " (" . $projectCount . ")" ?></h1>
    <?php } ?>
    <!-- if there´s not yet data -->
    <?php if($projectCount == 0) {?>
        <div>
            <p>You have not yet added any project</p>
            <p><a href='../controllers/project-php'>Add project</a></p>
        </div>
    <?php }?>
    <ul>
        <?php foreach ($projects as $project) : ?>
            <li>
                <a href="../controllers/project.php?id=<?php echo $project['id'];?>">
                <?php echo escape($project["title"])?>
                </a>
            <form method="post">  
                <input type="hidden" value="<?php echo $project['id'];?>" name="delete">
                <input type="submit" value="Delete: <?php echo $project["title"];?>" class="delete">
            </form>
            </li>
            <?php endforeach; ?>
    </ul>
</div>
<?php
$content = ob_get_clean();
include 'layout.php'
?>