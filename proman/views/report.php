<?php
$title = 'Dashboard';

ob_start();
require 'nav.php';
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../public/js/barchart.js" defer></script>
<div class="report">
<table>
    <thead>
    <th>Project</th>
    <th>Category</th>
    <th>Task count</th>
    </thead>
    <tbody>
        <?php foreach($reportdata as $data) { ?>
            <tr>
            <td><?php echo $data['title']?></td>
            <td><?php echo $data['category']?></td>
            <td><?php echo $data['taskcount']?></td>
            </tr>
        <?php } ?>    
    </tbody>
</table>
    <div class="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>