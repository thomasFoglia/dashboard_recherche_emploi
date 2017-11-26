<?php
include('../model/Candidature.php');
include('../model/BDD.php');

$id = $_POST["id"];
$reponse = $_POST["reponse"];

$obj = (object)array('id' => $id);
$cand = new Candidature($obj);
$cand->updateReponse($id, $reponse);
 ?>
