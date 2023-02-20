<?php 
function fileEmpty($size){
if($size === 0){
    return die("The file is empty");
}
}
function fileLarge($size){
    if($size >3145728){
        return die ("The file is too large");
    }
}
function fileTypeCheck($allowedTypes,$type){
    if(!in_array($type, array_keys($allowedTypes))){
        return die ("File not allowed");
    }
}
?>