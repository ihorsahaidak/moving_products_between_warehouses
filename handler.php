<?php

$file = 'data.json';
$csv = array();
if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    $ext = explode('.', $_FILES['csv']['name'])[1];
    $tmpName = $_FILES['csv']['tmp_name'];
    if($ext === 'csv'){
        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
            set_time_limit(0);
            while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                array_push($csv, $data);
            }
            fclose($handle);
        }
    }
}

$current_data = (array)json_decode(file_get_contents($file));
$tmp = [];
$curr_data_unseting = [];
$curr_title = [];
foreach ($current_data as $key => $value) {
    array_push($curr_title, $value[0].'-'.$value[2]);
}
foreach ($current_data as $currKey => $curr) {
    foreach ($csv as $newKey => $new) {
        if($curr[0] == $new[0]){
            if($curr[2] == $new[2]){
                if($curr[1] + $new[1] > 0){
                    array_push($tmp, [$curr[0], $curr[1] + $new[1], $curr[2]]);
                    unset($csv[$newKey]);
                }else{
                    array_push($curr_data_unseting, $currKey);
                }
            }else{
                if(!in_array($new[0].'-'.$new[2], $curr_title)){
                    if($new[1] > 0){
                        array_push($tmp, $new);
                      unset($csv[$newKey]);
                    }
                }
            }
        }else{
            if(!in_array($new[0].'-'.$new[2], $curr_title)){
                if($new[1] > 0){
                    array_push($tmp, $new);
                  unset($csv[$newKey]);
                } 
            }
        }
    }        
        $temp = 0;
        foreach ($tmp as $key => $value) {
            if($curr[0] == $value[0]){
                $temp = 1;
            }
        }
        if($temp == 0){
            if(!in_array($currKey, $curr_data_unseting)){
                array_push($tmp, $curr);
                unset($current_data[$currKey]);
            }   
        }
}

file_put_contents($file, json_encode((object)$tmp));
header('Location: index.php');
exit;


