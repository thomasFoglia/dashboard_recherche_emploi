<?php
include('../model/BDD.php');

$id = $_POST["id"];
$rappel_to_update = $_POST["rappel"];

$obj = (object)array('id' => $id);
$cand = new BDD();
$cand->updateRappel($id, $rappel_to_update);
 ?>
