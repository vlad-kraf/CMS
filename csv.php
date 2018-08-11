<?php

$data = array (
    array('test','1','test@gmail.com'),
    array('test2','2','test2@gmail.com'),
    array('test3','3','test3@gmail.com'),
    array('test4','4','test4@gmail.com'),
    array('test5','5','test5@gmail.com'),
);


/*
//write to file
$h = fopen('data.csv', 'w');
foreach ($data as $row) {
    fputcsv($h,$row,',');
}
fclose($h);

*/

//Read from file
$h = fopen('data.csv', 'r');
$datacsv = array();
while ($row = fgetcsv($h)){
 $datacsv[] = $row;
}
fclose($h);

echo "<pre>";
print_r($datacsv);
echo "</pre>";


//ftell - показать позиуию, fseek - передвинуться на позицию.