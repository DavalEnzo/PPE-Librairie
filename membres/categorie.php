<?php
require_once 'entete.php';
?>
<div class="m-1 text-dark text-center MomentBG" data-aos='fade-down' data-aos-duration="3000">
    <h1 class="textColor MomentBG">Vous trouverez ici tout les genres de livres que nous possédons.</h1>
</div>
<div class='container' data-aos='fade-left' data-aos-duration="3000">

    <?php
    $Bibli = new Bibliotheque();
    try {
        $genres =   $Bibli->getGenres();
    } catch (Exception $e) {
    ?>
        <div class="alert alert-danger">Erreur lors de la récupération des genres</div>
    <?php
    }
    ?>
    <?php

    ?>

        <?php


        foreach ($genres as $genre) {
        ?>

            <div class="card text-center stext textColor BackGround">
                <h4><?= $genre->getNomGenre(); ?></h6>
            </div>
            <?php
            foreach ($genre->getTypeGenre() as $tg) {
            ?>
                <div class=" d-inline-block rounded-circle text-center mx-4" style="width: 120px;height:120px;margin:auto;text-decoration:none; color:black;background-color:white;background-image:url('<?= $genre->getImgGenre(); ?>');background-size:cover;">
                    <a href="selectionGenre.php?idTypeGenre=<?= $tg->getIdTypeGenre(); ?>" style='text-decoration:none'>
                        <div class='my-4'>
                            <p class='stext ' style='color:white;'><?= $tg->getLibelle(); ?></p>
                        </div>
                    </a>
                </div>
        <?php
            }
        }
        ?>
</div>
<?php
require_once 'pied.php';
