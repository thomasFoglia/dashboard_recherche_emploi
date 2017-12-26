<?php


class BDD {


  public $db;

  public $id;
  public $entreprise;
  public $adresse;
  public $dateDemande;
  public $telephone;
  public $mail;
  public $dateRappel;
  public $lien_annonce;
  public $commentaire;
  public $reponse;

  function __construct(
    $id = null,
    $entreprise = null,
    $adresse = null,
    $dateDemande = null,
    $telephone = null,
    $mail = null,
    $dateRappel = null,
    $commentaire = null,
    $lien_annonce = null,
    $reponse = null) {

      $this->id = $id;
      $this->entreprise = $entreprise;
      $this->adresse = $adresse;
      $this->dateDemande = $dateDemande;
      $this->telephone = $telephone;
      $this->mail = $mail;
      $this->dateRappel = $dateRappel;
      $this->commentaire = $commentaire;
      $this->lien_annonce = $lien_annonce;
      $this->reponse = $reponse;

      $this->connexion();
    }

    public function connexion() {
      $this->db = new PDO('mysql:host=localhost;dbname=emploi;charset=utf8mb4', 'root', '');

    }

    public function getAllCandidatures() {
      $sql = 'SELECT * FROM enregistrement ORDER BY id DESC';

      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $all = [];
      while ($row = $stmt->fetch()) {
        $all[] = $row;
      }
      return $all;
    }

    public function issetCandidature($id) {
      if ($id == null) {
        return false;
      } else {
        return true;
      }
    }

    public function update() {
      die("controller update");
    }

    public function insert() {

      $entreprise = $this->entreprise;
      $adresse = $this->adresse;
      $dateDemande = $this->dateDemande;
      $telephone = $this->telephone;
      $mail = $this->mail;
      $commentaire = $this->commentaire;
      $lien_annonce = $this->lien_annonce;
      
      $sql = "INSERT INTO enregistrement (`entreprise`, `adresse`, `dateDemande`, `telephone`, `mail`, `dateRappel`,`commentaire`, `lien_annonce`, `reponse`)
      VALUES (:entreprise, :adresse, :dateDemande, :telephone, :mail, null, :commentaire, :lien_annonce, null)";
      $req = $this->db->prepare($sql);

      $req->bindParam(':entreprise', $entreprise);
      $req->bindParam(':adresse', $adresse);
      $req->bindParam(':dateDemande', $dateDemande);
      $req->bindParam(':telephone', $telephone);
      $req->bindParam(':mail', $mail);
      $req->bindParam(':commentaire', $commentaire);
      $req->bindParam(':lien_annonce', $lien_annonce);

      $req->execute();
      return true;
    }

    public function save() {
      if ($this->issetCandidature($this->id)) {
        return $this->update($this);
      } else {
        return $this->insert($this);
      }
    }

    public function getNbEnAttente() {
      $sql = 'SELECT `id` FROM enregistrement WHERE `reponse` IS NULL';
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->rowCount();
    }

    public function getNbRefus() {
      $sql = 'SELECT `id` FROM enregistrement WHERE `reponse` LIKE "non"';
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->rowCount();
    }

    public function getTotalNumber() {
      $sql = 'SELECT `id` FROM enregistrement';
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->rowCount();
    }

    public function getDateDaysAgo($nb_days) {
      $date = new DateTime(date("Y-m-d"));
      $date->sub(new DateInterval('P' . $nb_days .'D'));
      return $date->format('Y-m-d');
    }

    public function getTotalArelancer($nb_days) {
      $date_max = $this->getDateDaysAgo($nb_days);

      // pas rappelé au bout de 5 jours
      $sql = "SELECT `id` FROM enregistrement WHERE dateDemande <= '$date_max' AND `dateRappel` IS NULL AND `reponse` IS NULL";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $nb1 = $stmt->rowCount();

      // pas rappelé au bout de 5 jours après le premier rappel
      $sql2 = "SELECT `id` FROM enregistrement WHERE `dateRappel` IS NOT NULL AND `dateRappel` <= '$date_max' AND `reponse` IS NULL";
      $stmt2 = $this->db->prepare($sql2);
      $stmt2->execute();
      $nb2 = $stmt2->rowCount();

      $ret = $nb1 + $nb2; // total a relancer

      return $ret;
    }


    public function getListeArelancer($nb_days) {
      $date_max = $this->getDateDaysAgo($nb_days);

      $a_relancer = array();
      // pas rappelé au bout de 5 jours
      $sql = "SELECT * FROM enregistrement WHERE dateDemande <= '$date_max' AND `dateRappel` IS NULL AND `reponse` IS NULL";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      while ($row = $stmt->fetch()) {
        $entreprise = $row["entreprise"];
        $dateDemande = $row["dateDemande"];
        $telephone = $row["telephone"];
        $mail = $row["mail"];
        $dateRappel = $row["dateRappel"];

        $a_relancer[] = array(
          "entreprise" => $entreprise,
          "dateDemande" => $dateDemande,
          "coordonnees" => array("telephone" => $telephone, "mail" => $mail),
          "dateRappel" => $dateRappel
        );
      }

      // pas rappelé au bout de 5 jours après le premier rappel
      $sql = "SELECT * FROM enregistrement WHERE `dateRappel` IS NOT NULL AND `dateRappel` <= '$date_max' AND `reponse` IS NULL";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      while ($row = $stmt->fetch()) {
        $entreprise = $row["entreprise"];
        $dateDemande = $row["dateDemande"];
        $telephone = $row["telephone"];
        $mail = $row["mail"];
        $dateRappel = $row["dateRappel"];

        $a_relancer[] = array(
          "entreprise" => $entreprise,
          "dateDemande" => $dateDemande,
          "coordonnees" => array("telephone" => $telephone, "mail" => $mail),
          "dateRappel" => $dateRappel
        );
      }

      return $a_relancer;
    }

    public function getNbCandidatureLastDays($nb_days) {
      $date_max = $this->getDateDaysAgo($nb_days);

      $sql = "SELECT `id` FROM `enregistrement` WHERE `dateDemande` >= '$date_max'";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->rowCount();
    }

    public function updateRappel($id, $rappel) {

      $sql = "UPDATE enregistrement SET `dateRappel`= '".$rappel."' WHERE `id` = '".$id."' ";
      $req = $this->db->prepare($sql);
      $ret = $req->execute(array(
        "dateRappel" => $rappel,
        "id" => $id
      ));
      return true;
    }

    public function updateReponse($id, $reponse) {

      $sql = "UPDATE enregistrement SET `reponse`= '".$reponse."' WHERE `id` = '".$id."' ";
      $req = $this->db->prepare($sql);
      $ret = $req->execute(array(
        "reponse" => $reponse,
        "id" => $id
      ));
      return true;
    }

  }
