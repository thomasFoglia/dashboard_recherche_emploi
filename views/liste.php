<div class="content-wrapper" style="margin-left:0;">
  <div class="container-fluid">

    <div id="alertTop" class="alert alert-success alert-success fade show" role="alert" style='display:none;'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span class="text"></span>
    </div>

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
            <?php
            $style_no_contact = sizeof($all_candidatures_en_cours_no_contact) > 0 ? "font-weight:bold'" : "";
            ?>
            <div class="mr-5"><?= $nb_en_attente ?> candidatures en cours <span style='<?= $style_no_contact?>'>(dont <?= sizeof($all_candidatures_en_cours_no_contact) ?> sans contacts</span>)
              <br><span style='font-size:13px;'><i><?= $total ?> candidatures envoyées au total</i></span>
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
            <div class="mr-5"><?= $nb_candidatures_last_days ?> nouvelles candidatures<br>
              <span style='font-size:13px;'>ces <?= $nb_days_created_last_days ?> derniers jours</div></span>
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
              <div class="mr-5"><?= $total_a_relancer ?> entreprises <br><span style='font-size:13px;'>à relancer</span></div>
            </div>
          </div>
        </div>
      </div>

      <!-- candidatures en cours -->
      <div class="card mb-3">
        <div class="card-header">
          <?php
          $style_no_contact = sizeof($all_candidatures_en_cours_no_contact) > 0 ? "font-weight:bold'" : "";
          ?>
          <i class="fa fa-table"></i> &nbsp;<?= sizeof($all_candidatures_en_cours) ?> candidatures en cours (<span style='<?=$style_no_contact?>'>dont <?= sizeof($all_candidatures_en_cours_no_contact) ?> sans contacts </span>)</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTableEnCours" width="100%" cellspacing="0" style='font-size:12px;'>
                <thead>
                  <tr>
                    <th style='display:none;'>ID</th>
                    <th>Date</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Adresse</th>
                    <th>Mail</th>
                    <th>Tél.</th>
                    <th>Com.</th>
                    <th style='width:45px !important;'>Rappelé ?</th>
                    <th style='width:45px !important;'>Réponse</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($all_candidatures_en_cours as $cand) {
                    $id = $cand['id'];

                    // candidatures dont on n'a pas les coordonnées pour rappeler
                    $style_tr = "";
                    if ($cand["mail"] == "" && $cand["telephone"] == "") {
                      $style_tr = "#f4f4f4"; // gris
                    }
                    if (in_array($cand["entreprise"], $entr_a_relancer)) {
                      $style_tr = "#ffb3b3"; // gris
                    }
                    ?>
                    <tr style='background-color: <?= $style_tr ?>'>
                      <td class='id_to_update' style='display:none;'><?= $cand["id"] ?></td>
                      <td><?= date("d/m/Y", strtotime($cand["dateDemande"])); ?> <br>
                        <?php
                        $array_liens = explode(" ", $cand["lien_annonce"]);
                        foreach ($array_liens as $lien) {
                          if ($lien != "") {
                            echo "<a target=_blank href=$lien>Lien<br>";
                          }
                        } ?>
                      </td>
                      <td class='name_to_update' ><?= $cand["entreprise"] ?></td>
                      <td>
                        <input style='background-color:<?=$style_tr?>' class='input_ajax_save' type='text' target='ajax/updateField' param_id="<?=$id?>" param_field="type" value="<?= $cand["type"] ?>">
                      </td>
                      <td>

                        <input placeholder='Adresse' style='background-color:<?=$style_tr?>' class='input_ajax_save' type='text' target='ajax/updateField' param_id="<?=$id?>" param_field="adresse" value="<?= $cand["adresse"] ?>">
                        <br>
                        <?php if ($cand["adresse"] != "") { ?>
                          <a target=_blank href="https://www.google.fr/maps/dir/41+Boulevard+Joseph+Vallier,+Grenoble/<?= $cand["adresse"] ?>">Itinéraire
                          <?php } ?>

                        </td>
                        <td>
                          <input placeholder='Mail' style='background-color:<?=$style_tr?>' class='input_ajax_save' type='text' target='ajax/updateField' param_id="<?=$id?>" param_field="mail" value="<?= $cand["mail"] ?>">
                        </td>

                        <td>
                          <input placeholder='Tél.' style='background-color:<?=$style_tr?>' class='input_ajax_save' type='text' target='ajax/updateField' param_id="<?=$id?>" param_field="telephone" value="<?= $cand["telephone"] ?>">
                        </td>

                        <td>
                          <input placeholder='Com.' style='background-color:<?=$style_tr?> 'class='input_ajax_save' type='text' target='ajax/updateField' param_id="<?=$id?>" param_field="commentaire" value="<?= $cand["commentaire"] ?>">
                        </td>
                        <?php
                        // refus
                        if($cand["reponse"] == "non") {
                          $dateRappel = "Non mais refus";
                        } else if($cand["dateRappel"] == null) {
                          $dateRappel = "Pas encore<br><br><button type='button' class='btn_rappel btn btn-outline-secondary' style='width:100%'>Maintenant</button>";
                        } else {
                          $dateRappel = date("d/m/Y", strtotime($cand["dateRappel"]));
                          $dateRappel .= "<br><br><button type='button' class='btn_rappel btn btn-outline-secondary' style='width:100%'>Maintenant</button>";
                        }
                        // si on ne peut pas rappeler : pas de mail ni téléphone
                        if ($cand["mail"] == null && $cand["telephone"] == null) {
                          $dateRappel = "Aucun contact";
                        }
                        ?>
                        <td style='text-align:center;'><?= $dateRappel ?></td>
                        <td>
                          <?php if($cand["reponse"] == "non") {
                            echo "Non";
                          } else { ?>
                            <select style='background-color:<?=$style_tr?>' class="btn_reponse form-control">
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
          </div>

          <br><br><br>
          <!--  candidatures refusées -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> &nbsp;<?= sizeof($all_candidatures_refused) ?> candidatures refusées</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTableRefused" width="100%" cellspacing="0" style='font-size:12px;'>
                    <thead>
                      <tr>
                        <th style='display:none;'>ID</th>
                        <th>Date</th>
                        <th>Entreprise</th>
                        <th>Adresse</th>
                        <th>Mail</th>
                        <th>Tél.</th>
                        <th>Com.</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($all_candidatures_refused as $cand) {

                        ?>
                        <tr>
                          <td class='id_to_update' style='display:none;'><?= $cand["id"] ?></td>
                          <td><?= date("d/m/Y", strtotime($cand["dateDemande"])); ?><br>
                            <?php
                            $array_liens = explode(" ", $cand["lien_annonce"]);
                            foreach ($array_liens as $lien) {
                              if ($lien != "") {
                                echo "<a target=_blank href=$lien>Lien<br>";
                              }
                            }?>
                          </td>
                          <td class='name_to_update' ><?= $cand["entreprise"] ?></td>
                          <td><?= $cand["adresse"] ?>
                            <br>
                            <?php if ($cand["adresse"] != "") { ?>
                              <a target=_blank href="https://www.google.fr/maps/dir/41+Boulevard+Joseph+Vallier,+Grenoble/<?= $cand["adresse"] ?>">Itinéraire
                              <?php } ?>
                              <td><?= $cand["mail"] ?></td>
                              <td><?= $cand["telephone"] ?></td>

                              <td><?= $cand["commentaire"] ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>


              </div>
            </div>
