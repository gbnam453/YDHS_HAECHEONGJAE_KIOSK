<?php
$temp = array();

$i = 1;
while($i<=$_GET['h'])
{
    
    $ii = 1;
    $temp2 = array();
    while($ii<=$_GET['w'])
	{
        array_push($temp2, 'false');
		$ii++;
	}
    array_push($temp, $temp2);
    $i++;
}

$myfile = fopen("floor".$_GET['floor'].".json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($temp));
fclose($myfile);

header("Location: ".$_SERVER['HTTP_REFERER']);


?>