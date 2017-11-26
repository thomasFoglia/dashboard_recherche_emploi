<?php
class Candidature {

public $bdd = null;

public $id;
public $entreprise;
public $adresse;
public $dateDemande;
public $telephone;
public $mail;
public $dateRappel;
public $lien_annonce;
public $reponse;

function __construct(
$id = null ,
$entreprise = null,
$adresse = null,
$dateDemande =null,
$telephone = null,
$mail = null,
$dateRappel = null,
$lien_annonce = null,
$reponse = null) {

  $this->id = $id;
  $this->entreprise = $entreprise;
  $this->adresse = $adresse;
  $this->dateDemande = $dateDemande;
  $this->telephone = $telephone;
  $this->mail = $mail;
  $this->dateRappel = $dateRappel;
  $this->lien_annonce = $lien_annonce;
  $this->reponse = $reponse;

  $this->bdd = new BDD($this);
}

public function save() {
  $this->bdd->save();
}

public function updateRappel($id, $rappel) {
    return $this->bdd->updateRappel($id, $rappel);
}

public function updateReponse($id, $reponse) {
    return $this->bdd->updateReponse($id, $reponse);
}

public function getAllCandidatures() {
  return $this->bdd->getAll();
}

public function getNbEnAttente() {
  return $this->bdd->getNbEnAttente();
}

public function getNbRefus() {
  return $this->bdd->getNbRefus();
}

public function getTotalNumber() {
  return $this->bdd->getTotalNumber();
}

public function getTotalArelancer($nb_days) {
  return $this->bdd->getTotalArelancer($nb_days);
}

public function getListeArelancer($nb_days) {
  return $this->bdd->getListeArelancer($nb_days);
}

public function getNbCandidatureLastDays($nb_days) {
  return $this->bdd->getNbCandidatureLastDays($nb_days);
}

}

 ?>
