<?php 
if(!empty($_GET['id'])){
    $title = 'Update project';
}else {
    $title = 'Add Project';
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
    <form method="post" class="add-item">
        <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" name="title" id="title" class="basic-text" placeholder="New project" 
        value="<?php echo $project_title;?>" required>
        <label for="category">
            <span>Category:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <select name="category" id="category" class="dropdown" required>
            <option value="">Select category</option>
            <option value="Professional"
            <?php if($category == "Professional") {echo ' selected';}?>>Professional</option>
            <option value="Personal"
            <?php if($category == "Personal") {echo ' selected';}?>>Personal</option>
            <option value="School"
            <?php if($category == "School") {echo ' selected';}?>>School</option>
        </select>
        <?php if (!empty($id)) { ?>
        <input type="hidden" name="id" value="<?php echo $id?>"/>    
        <?php } ?>
        <br>
        <input type="submit" class="buttons" name="submit" value="<?php echo (isset($id) and (!empty($id))) ? "Update" : "Add" ?>">
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>