<?php
include('../model/Candidature.php');
include('../model/BDD.php');

$id = $_POST["id"];
$rappel_to_update = $_POST["rappel"];

$obj = (object)array('id' => $id);
$cand = new Candidature($obj);
$cand->updateRappel($id, $rappel_to_update);
 ?>
