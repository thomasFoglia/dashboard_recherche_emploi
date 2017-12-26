<?php
include('../model/BDD.php');

$id = $_POST["id"];
$reponse = $_POST["reponse"];

$obj = (object)array('id' => $id);
$cand = new BDD($obj);
$cand->updateReponse($id, $reponse);
 ?>
