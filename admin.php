<?php
require_once ('FONCTION/fonction.php');

if(!isset($listmot)){
    $listmot = file("mot.txt");
    $mottotal = count($listmot,) -1;
}
if(!isset($_GET["lemot"])){
    $key = $_GET["lemot"];
    unset($arrayMot[$key]);
    file_put_contents("mot.txt", $arrayMot);
    header("location: admin.php");
}

?>