<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href=".">Recherche emploi</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="nav nav-tabs" id="nav_alertsDropdown">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-fw fa-bell"></i>
        <?php
        $class = "text-danger";
        if ($total_a_relancer == 0) {
          $class = "text-success";
        }
        ?>
        <span class="indicator <?= $class ?> d-none d-lg-block">
          <i class="" style="font-weight:bold;padding: 0 8px;font-size: 14px; "><?= $total_a_relancer ?></i>
        </span>
      </a>
      <div class="dropdown-menu" aria-labelledby="alertsDropdown"style="width: 900px;">
        <?php
        $size_array = count($liste_a_relancer);
        if ($size_array >= 1) {
          echo "<h6 class='dropdown-header'>$total_a_relancer entreprises à relancer :</h6>";
        } else {
          echo "<h6 class='dropdown-header'>0 entreprises à relancer.</h6>";
        }
        $i = 1;
        foreach ($liste_a_relancer as $relance) { ?>

          <a class="dropdown-item">
            <span class="text-danger">
              <strong>
                <!-- <i class="fa fa-arrow-right fa-fw"></i> -->
                <?= $relance["entreprise"] ?></strong>
              </span>
              <span class="small float-right text-muted">Candidature envoyée le <b><?=  date("d/m/Y", strtotime($relance["dateDemande"])); ?></b></span>
              <?php if ($relance["dateRappel"] != null) { ?>
                <br><span class="small float-right text-muted">Premier rappel le <b><?=  date("d/m/Y", strtotime($relance["dateRappel"])); ?></b></span>
              <?php } else { ?>
                <br><span class="small float-right text-muted">Pas encore rappelé</span>
              <?php } ?>
              <?php if ($relance["coordonnees"]["telephone"] != null) { ?>
                <div class="dropdown-message small">Tél : <b><?= $relance["coordonnees"]["telephone"] ?></b></div>
              <?php } ?>
              <?php if ($relance["coordonnees"]["mail"] != null) { ?>
                <div class="dropdown-message small">Mail : <b><?= $relance["coordonnees"]["mail"] ?></b></div>
              <?php } ?>
              <?php if ($relance["coordonnees"]["telephone"] == null && $relance["coordonnees"]["mail"] == null) { ?>
                <div class="dropdown-message small"><b>Aucun contact ...</b></div>
              <?php } ?>
            </a>
            <?php if($size_array > $i) { // empeche un divider en trop sur le dernier item de la liste?>
              <div class="dropdown-divider"></div>
            <?php } $i++; } ?>
          </li>
        </ul>
      </div>


    </li>
  </ul>


  <ul class="navbar-nav ml-auto" style="margin:0!important;float:left;">

    <li>
      <a class="nav-link" href=".">
        <i class="fa fa-fw fa-table"></i>
        <span class="nav-link-text">Tableau de bord</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="candidature">
        <i class="fa fa-fw fa-plus"></i>
        <span class="nav-link-text">Nouvelle candidature</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="fonctionnement">
        <i class="fa fa-fw fa-question"></i>
        <span class="nav-link-text">Fonctionnement</span>
      </a>
    </li>

  </nav>
