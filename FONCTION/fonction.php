<?php 

function chooseWord($words) 
{
    $t = [];
    foreach ($words as $word) {
        array_push($t, trim($word));
    }
    return $t;
}

?>