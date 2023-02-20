<?php
require_once "../model/model.php";
$reportdata = barchart_report_data();
$data = [];
foreach ($reportdata as $reportdata) {
array_push($data, array('title' => $reportdata['title'], 'Count' => $reportdata['taskcount']));
}
echo json_encode($data);


?>