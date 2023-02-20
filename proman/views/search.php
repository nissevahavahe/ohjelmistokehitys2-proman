<?php
$title = 'Search';
ob_start();
require 'nav.php'
?>
<script src="../public/js/app.js" defer></script>
<div class="livesearch">
    <label for="search">Search project or task</label>
    <input type="text" name="search" id="searchfield" class="basic-text" oninput="liveresults(this.value)">
</div>
<div class="results">
        <ul id="results">
            
        </ul>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>