<?php
if (
  isset($_POST["entreprise"]) &&
  isset($_POST["adresse"]) &&
  isset($_POST["telephone"]) &&
  isset($_POST["mail"]) &&
  isset($_POST["lien_annonce"])
) {
  $id = null;
  $entreprise = $_POST["entreprise"];
  $adresse = $_POST["adresse"];
  $dateDemande = date('Y-m-d');
  $telephone = $_POST["telephone"];
  $mail = $_POST["mail"];
  $dateRappel = null;
  $commentaire = $_POST["commentaire"];
  $lien_annonce = $_POST["lien_annonce"];
  $reponse =  null;

  $candidature = new Candidature($id, $entreprise, $adresse, $dateDemande, $telephone, $mail, $dateRappel, $commentaire, $lien_annonce, $reponse);
  $candidature->save();
  echo "<script type='text/javascript'>document.location.replace('/emploi/');</script>";
}

?>

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Tableau de bord</a>
      </li>
      <li class="breadcrumb-item active">Nouvelle candidature</li>
    </ol>
    <div class="row">
      <div class="col-lg-12">
        <div class="container">
          <div class="card-body">
            <form action="" method='post'>
              <div class="form-group">
                <label for="entreprise">Entreprise</label>
                <input class="form-control" id="entreprise" name="entreprise" type="text" placeholder="Nom de l'entreprise" required>
              </div>
              <div class="form-group">
                <label for="adresse">Adresse</label>
                <input class="form-control" id="adresse" name="adresse" type="text" placeholder="Adresse">
              </div>
              <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input class="form-control" id="telephone" name="telephone" type="text" placeholder="Téléphone">
              </div>
              <div class="form-group">
                <label for="mail">Mail</label>
                <input class="form-control" id="mail" name="mail" type="email" placeholder="Mail">
              </div>
              <div class="form-group">
                <label for="lien_annonce">URL vers l'annonce</label>
                <input class="form-control" id="lien_annonce" name="lien_annonce" type="text" placeholder="URL vers l'annonce">
              </div>
              <div class="form-group">
                <label for="lien_annonce">Commentaire</label>
                <input class="form-control" id="commentaire" name="commentaire" type="text" placeholder="Commentaire">
              </div>

              <br>
              <input class="btn btn-primary btn-block" type='submit' value="Ajouter">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
