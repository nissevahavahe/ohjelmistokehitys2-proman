<?php 
if(!empty($_GET['id'])){
 $title = "Update task";
}else {
$title = 'Add task';
}
ob_start();
require "nav.php"
?>

<div class="container">
    <h1><?php echo $title ?></h1>

    <?php
    if(isset($error_message)){
        echo "<p class='message_error'>$error_message</p>";
    }
    if(isset($confirm_message)){
        echo "<p class='message_ok'>$confirm_message</p>";
    }
    ?>
    <form method="post" class="add-item" enctype="multipart/form-data">
        <input type="submit" class="buttons" name="submit" value="<?php echo (isset($task_id) and (!empty($task_id))) ? "Press to Update" : " Press to Add" ?>">    
        <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" name="title" id="title" class="basic-text" placeholder="New task" 
        value="<?php if(!empty($_GET['id'])){
                        echo $task_title; }?>" required>
        <label for="category">
            <span>Project:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <select name="projects" id="projects" class="dropdown">
            <option value="">Select a project</option>
            <?php foreach($projects as $project){?>
                <option value="<?php echo $project['id'];?>" <?php if(!empty($_GET['id']) && $project['id'] === $project_id){echo ' selected';}?>>
            <?php echo $project['title']?></option>
            <?php } ?>
        </select>
        <br>
        <span>Date:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <br>
        <input type="date" name="date" id="date_task" class="basic-text"
            value="<?php if(!empty($_GET['id'])){
                            echo $date;
            }?>">
        <br>
        <span>Time:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <br>
        <input type="text" name="time" id="time_task" class="basic-text"
        value="<?php if(!empty($_GET['id'])){
                            echo $time;
            }?>">
        <?php if (!empty($task_id)) { ?>
        <input type="hidden" name="id" value="<?php echo $task_id?>"/>    
        <?php } ?>
        <br>
        <label for="task_upload">Upload an image for your task</label>
        <input type="file" name="task_upload" id="task_upload" class="basic-upload">
        <br>
        <br>
        <label for="images">You can only delete one picture at a time</label>
        <div class="image-box">
        <?php
        if (!empty($images)) {
        foreach($images as $img){
                ?><input type="checkbox" value="<?php echo $img['imgid'];?>" name="deleteimg">
            <img src="<?php echo "https://www.cc.puv.fi/~e2101563/proman/data/imports/" . $img['filepath']?>">
        <?php } }
        ?>
        </div>
        <?php if(!empty($_GET['id'])){ ?>
        <label for="comment">Insert a comment bellow</label>
        <input type="text" name="commentinput" id="commentinput" class="basic-text">
        <?php } ?>
    </form>
   <?php if (!empty($comments)) {
            ?> <h3>Comments</h3> <?php } ?>
    <div class="comment-box" name="comment-box" id="comment-box">
    <?php
        if (!empty($comments)) {
        foreach($comments as $comment){
                ?><div class="comment-item" id="comment_<?php echo $comment['commentId']?>">Comment: <?php echo $comment['comment'];?>
                <a href="./archive.php?id=<?php echo $_GET['id']?>&comment=<?php echo $comment['commentId']?>">Archive comment</a></div> <br> <br>
        <?php } }
        ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>