<?php
require_once "../model/model.php";
if(isset($_GET['id']) && isset($_GET['comment']))
{
    archive_comment($_GET['id'], $_GET['comment']);
    header(
        'location: ../controllers/task.php?id=' . $_GET['id']
    );
}

?>