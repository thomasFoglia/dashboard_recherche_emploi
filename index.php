<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Tableau de bord</title>
  <?php include('views/includes_css.php');
  include('model/BDD.php');
  ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php

  $candidature = new BDD();
  $all_candidatures_en_cours = $candidature->getAllCandidaturesEnCours();
  $all_candidatures_en_cours_no_contact = $candidature->getAllCandidaturesEnCoursNoContact();
  $all_candidatures_refused = $candidature->getAllCandidaturesRefused();
  $total = $candidature->getTotalNumber();
  $nb_en_attente = $candidature->getNbEnAttente();
  $nb_refus = $candidature->getNbRefus();
  $nb_days_created_last_days = 7; // parametre + string dans views/liste.php
  $nb_candidatures_last_days = $candidature->getNbCandidatureLastDays($nb_days_created_last_days);
  $nb_days_a_relancer = 5;
  $total_a_relancer = $candidature->getTotalArelancer($nb_days_a_relancer);
  $liste_a_relancer = $candidature->getListeArelancer($nb_days_a_relancer);
  $entr_a_relancer = [];
  foreach ($liste_a_relancer as $rel) {
    $entr_a_relancer[] = $rel["entreprise"];
  }

  include('views/navigation.php');
  include('views/liste.php');
  include('views/includes_js.php');
  include('views/footer.php');
  ?>
</body>

</html>
