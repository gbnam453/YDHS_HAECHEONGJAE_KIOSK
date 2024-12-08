<?php
$getdb = file_get_contents("./floor".$_GET['floor'].".json");
$json = json_decode($getdb, true);
$count = 1;
$count2 = 1;
$edit = array();

foreach($json as $putf) {
    $temp = array();
    foreach($putf as $chair){
        if($count == $_GET['table'] and $count2 == $_GET['chair']) {
            array_push($temp, $_GET['value']);
        } else {
            array_push($temp, $chair);
        }
        $count2++;
    }
    array_push($edit, $temp);
    $count2 = 1;
    $count++;
}

$myfile = fopen("floor".$_GET['floor'].".json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($edit));
fclose($myfile);

header("Location: ".$_SERVER['HTTP_REFERER']."&result=".$_GET['value']);


?>