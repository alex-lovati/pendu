<?php
require_once ('FONCTION/fonction.php');

if(!isset($listmot)){
    $listmot = file("mot.txt");
    $mottotal = count($listmot,) -1;
}
if(!isset($_GET["lemot"])){
    
}