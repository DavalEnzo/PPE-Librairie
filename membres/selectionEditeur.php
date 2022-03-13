<?php require_once 'entete.php';

if (isset($_GET['idEditeur']) && !empty($_GET['idEditeur'])) {
    $idEditeur = $_GET['idEditeur'];
}
$e = new Editeur($idEditeur);
$Livres = $e->getLivre();
$nomEditeur = $e->getNomEditeur();
$arrObj = new ArrayObject($Livres);

if ($arrObj->count() != 0) {
?>
    <div class="alert alert-info">
        <?php
        foreach ($Livres as $l) {
        }
        if ($arrObj->count() < 2) {
        ?>
            L'éditeur <?= $nomEditeur; ?> possède <?= $arrObj->count(); ?> livre.
        <?php
        } else {
        ?>
            L'éditeur <?= $nomEditeur; ?> possède <?= $arrObj->count(); ?> livres.
        <?php
        }
        ?>
    </div>
<?php
} else {
?>
    <div class="alert alert-warning">
        Cet éditeur ne possède aucun livre. Revenez plus tard !
    </div>
<?php
}
?>
<div class="card-group">
    <?php
    foreach ($Livres as $l) {
    ?>
        <a href="pageProduit.php?idLivre=<?= $l->getIdLivre() ?>">
            <div class="card mx-3 my-5 cardlivre" style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none">

                <img class="card-img-top imgCard" style="max-height:340px;" src="<?= $l->getPhoto() ?>">

                <div class="card-body" style="min-height:105px" id="card">
                    <h8 class="card-title"><?= $l->getTitre() ?></h8>
                    <?php
                    if ($l->getPrix() == 0.00) {
                    ?>
                        <p><strong>Libre de droit</strong></p>
                    <?php
                    } else {
                    ?>

                        <p class="card-text"><strong><?= $l->getPrix() ?> €</strong></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </a>
    <?php
    }
    ?>
</div>
<?php
require_once 'pied.php';
