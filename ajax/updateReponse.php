<?php
include('../model/BDD.php');

$id = $_POST["id"];
$reponse = $_POST["reponse"];

$cand = new BDD($obj);
$cand->updateReponse($id, $reponse);
 ?>
