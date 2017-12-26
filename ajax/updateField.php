<?php
include('../model/BDD.php');

$id = $_POST["id"];
$field = $_POST["field"];
$value = $_POST["value"];

$cand = new BDD();
echo $cand->updateField($id, $field, $value);
 ?>
