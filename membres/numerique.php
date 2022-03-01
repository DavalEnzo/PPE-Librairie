<?php
require_once "entete.php";
$BibliNum = new Bibliotheque();

$livrenums = $BibliNum->getLivres();

if (isset($_SESSION["idUtilisateur"]) && !empty($_SESSION['idUtilisateur'])) {
?>
    <div class='card-group' style="margin-left: 10%;">
        <?php
        foreach ($livrenums as $livrenum) {
            if ($livrenum->getPrix() == 0.00) {

        ?>
                <a href="pageProduit.php?idLivre=<?= $livrenum->getIdLivre() ?>">
                    <div class="card mx-3 my-5 cardlivre" style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none">

                        <img class="card-img-top" style="max-height:340px;" src="<?= $livrenum->getPhoto() ?>">
                        <div class="card-body" style="min-height:105px" id="card">
                            <h8 class="card-title"><?= $livrenum->getTitre() ?></h8>
                            <?php
                            if ($livrenum->getPrix() == 0.00) {
                            ?>
                                <p>Libre de droit</p>
                            <?php
                            } else {
                            ?>

                                <p class="card-text"><?= $livrenum->getPrix() ?> €</p>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </a>
        <?php
            } else {
                continue;
            }
        }
        ?>
    </div>
<?php
    require_once 'pied.php';
} else {
?>
    <div class="alert alert-danger container text-center" style="margin-top: 15%;">Vous devez vous connecter et/ou être inscrit afin de pouvoir lire des livres numériques</div>
    <?php
    require_once 'pied.php';
    ?>
<?php
}
