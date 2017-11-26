<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Tableau de bord</a>
      </li>
      <li class="breadcrumb-item active">Liste des demandes</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5"><?= $total ?> candidatures au total
              <br><span style='font-size:13px;'><i><?= $nb_en_attente ?> en cours</i></span>
              <span style='font-size:13px;'><i>et <?= $nb_refus ?> refus</i></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-comments"></i>
            </div>
            <div class="mr-5"><?= $nb_candidatures_last_days ?> nouvelles candidatures<br>ces <?= $nb_days_created_last_days ?> derniers jours</div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-sm-6 mb-3">
        <?php
        $class = "bg-danger";
        if ($total_a_relancer == 0) {
          $class = "bg-success";
        }
        ?>
        <div class="card text-white <?= $class ?> o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-exclamation-circle"></i>
            </div>
            <div class="mr-5"><?= $total_a_relancer ?> entreprises à relancer</div>
          </div>
        </div>
      </div>
    </div>
    <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Liste des demandes</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style='font-size:12px;'>
              <thead>
                <tr>
                  <th style='display:none;'>ID</th>
                  <th>Date demande</th>
                  <th>Entreprise</th>
                  <th>Adresse</th>
                  <th>Mail</th>
                  <th>Téléphone</th>
                  <th>Lien annonce</th>
                  <th>Rappelé?</th>
                  <th>Réponse</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($all_candidatures as $cand) { ?>
                  <tr>
                    <td class='id_to_update' style='display:none;'><?= $cand["id"] ?></td>
                    <td><?= date("d/m/Y", strtotime($cand["dateDemande"])); ?></td>
                    <td><?= $cand["entreprise"] ?></td>
                    <td><a target=_blank href="https://www.google.fr/maps/place/<?= $cand["adresse"] ?>"><?= $cand["adresse"] ?></td>
                      <td><?= $cand["mail"] ?></td>
                      <td><?= $cand["telephone"] ?></td>
                      <td><a target=_blank href="<?= $cand["lien_annonce"] ?>"><?= $cand["lien_annonce"] ?></td>
                        <?php
                        if($cand["reponse"] == "non") {
                          $dateRappel = "Non";
                        } else if($cand["dateRappel"] == null) {
                          $dateRappel = "<button type='button' class='btn_rappel btn btn-outline-secondary' style='width:100%'>Oui</button>";
                        } else {
                          $dateRappel = date("d/m/Y", strtotime($cand["dateRappel"]));
                        }
                        ?>
                        <td><?= $dateRappel ?></td>
                        <td>
                          <?php if($cand["reponse"] == "non") {
                            echo "Non";
                          } else { ?>
                            <select class="btn_reponse form-control">
                              <option></option>
                              <option value='non'>Non</option>
                            </select>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
          </div>
        </div>
      </div>
