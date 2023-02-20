<?php
require_once "../model/model.php";
$id = $_GET['id'];
$task = get_task($id);

ICS($task['date_task'],$task['date_task'],$task['title'],'Tämä on testi','Helsinki');

function ICS($start,$end,$name,$description,$location) {
    $name = $name;
    $data = "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\nBEGIN:VEVENT\nDTSTART:".date("Ymd\THis\Z",strtotime($start))."\nDTEND:".date("Ymd\THis\Z",strtotime($end))."\nLOCATION:".$location."\nTRANSP: OPAQUE\nSEQUENCE:0\nUID:\nDTSTAMP:".date("Ymd\THis\Z")."\nSUMMARY:".$name."\nDESCRIPTION:".$description."\nPRIORITY:1\nCLASS:PUBLIC\nBEGIN:VALARM\nTRIGGER:-PT10080M\nACTION:DISPLAY\nDESCRIPTION:Reminder\nEND:VALARM\nEND:VEVENT\nEND:VCALENDAR\n";
    file_put_contents($name . ".ics", $data);
    header("Content-type:text/calendar");
    header('Content-Disposition: attachment; filename="'.$name.'.ics"');
    Header('Content-Length: '.strlen($data));
    Header('Connection: close');
}

?>