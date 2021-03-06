<?php require_once 'entete.php';

if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
  $recherche = $_GET['recherche'];
  try {
    $bibli = new Bibliotheque(false);
    $bibli->rechercherLivre($recherche);
    $resultats = $bibli->getLivres();
  } catch (Exception $e) {
?>
    <div class="alert alert-danger text-center">Erreur lors de la recherche</div>
<?php
  }
} else {
  header('Location:index.php');
}
?>
<?php
if (empty($resultats)) {
?>
  <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left:33%; margin-top:5%; width:35%">
    <div class="toast-body text-center">
      Aucun résultat trouvé
      <div class="mt-2 pt-2 border-top text-center">
        <a href="index.php" type="button" class="btn btn-primary btn-sm">Retrourner à l'accueil</a>
      </div>
    </div>
  </div>
<?php
}

?>
<div class="card-group mb-3">
  <?php
  if (!empty($resultats)) {

    foreach ($resultats as $resultat) {
  ?>
   <a href="pageProduit.php?idLivre=<?= $resultat->getIdLivre() ?>">
      <div class="card mx-3 my-5 cardlivre" style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none;">
        <img class="card-img-top" style="max-height:340px" src="<?= $resultat->getPhoto() ?>">
        <div class="card-body" id="card" style="min-height:105px;">
          <h6 class="card-title"><?= $resultat->getTitre() ?></h6>
          <?php
          if ($resultat->getPrix() == 0.00) {
          ?>
            <p><strong>Libre de droit</strong></p>
          <?php
          } else {
          ?>

            <p class="card-text"><?= $resultat->getPrix() ?> €</p>
          <?php
          }
          ?>
        </div>
      </div>
      </a>
  <?php
    }
  }
  ?>
</div>
<?php
require_once 'pied.php';
