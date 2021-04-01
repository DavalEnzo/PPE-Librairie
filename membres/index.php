<?php
require_once 'entete.php';

$livres = selectBibli();
?>
<div class="body">
  <div class="toutnoir">
      <div style="background-image:url('Books-banner.jpg');">
          <div style="background-color:rgba(0,0,0,0.5)">
              <div class="container text-center"
              data-aos="fade-down"
              data-aos-duration="3000"
              >
                <h1 class="display-4" style="font-size:50px; margin-left:5%; font-family:Brush Script MT; color:yellow;text-shadow: black 0.4em 0.1em 0.4em;">Des livres a n'importe quel moment où que vous soyez</h1>
              </div>
          </div>
      </div>
      <div class="container" style="max-width: 1280px"
                
      >
        <div class="p-1 mb-2 bg-info text-center"
                data-aos="fade-right"
                data-aos-duration="3000">
          <h2 class='fw-bold' style="text-decoration:underline; text-shadow: black 0.2em 0.1em 0.3em;">Les livres à la une</h2>
        </div>
        <?php
          $i = 0;
          ?>
        <div class="container my-5" style='height: 500px'>    
          <div id="carouselExampleCaptions" class="carousel slide col-md-3" style="margin:auto;width:17rem" data-bs-ride="carousel"
                data-aos="fade-left"
                data-aos-duration="3000">
                <ul class="carousel-indicators">
                      <?php
                        $i = 0;
                        foreach($livres as $livre){  
                            ?> 
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$i;?>" class="<?= ($i == 0 ? "active" : "");?>"></li>
                            
                            <?php
                          $i++;
                          }
                      ?>
              </ul>
            <div class="carousel-inner"
                >
            <?php
                $i = 0;
                foreach($livres as $livre){  
              ?> 
                  <div class="carousel-item <?= ($i == 0 ? "active" : "");?>"style="max-height:340px;max-width:17rem;min-width:17rem;min-height:340px" 
                  
                  >
                      <a href="pageproduit.php?idLivre=<?=$livre["idLivre"]?>"><img src="<?=$livre["Photo"]?>" class="d-block imgslide" style="height: 340px;width:17rem;filter:brightness(0.9)">
                    <div class="carousel-caption d-none d-md-block textcolor">
                      <h5 class="stext"><?=$livre["Titre"]?></h5>
                      <?php
                    if($livre['Prix']== 0.00){
                        ?>
                          <p class='stext'>Libre de droit</p>
                    <?php
                    }else{
                        ?>
                        
                      <p class="stext"><?=$livre["Prix"]?></p>
                      <?php
                    }
                    ?>
                    </div>  </a>
                  </div> 
                <?php
                $i++;
                } 
                ?>
            
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div> 
        
         <ul class="coucou">
         <?php
         foreach($livres as $livre){
         ?>
            <li>
              <img src="<?=$livre["Photo"]?>" class="imgslide">
            </li>
            <?php
            }
            ?>
         </ul>
        <h1 class="text-center my-3 stext"
              data-aos="fade-right"
              data-aos-duration="3000"
              style="color:white;" 
        >Les Nouveautés :</h1>
        <div class="card-group" style='margin:1rem;' >
          <?php
          $newLivres = selectBiblinew();
          foreach($newLivres as $newLivre){  
            ?>
          <div  class="card mx-3 my-5 cardlivre"
                data-aos="fade-left"
                data-aos-duration="3000"
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none;" >

                <img  class="card-img-top" style="max-height:340px;" src="<?=$newLivre["Photo"]?>">

                <div class="card-body" style="min-height:105px;" id="card" >
                    <h8 class="card-title"><?=$newLivre["Titre"]?></h8>
                    <?php
                    if($newLivre['Prix']== 0.00){
                        ?>
                        <p>Libre de droit</p>
                    <?php
                    }else{
                        ?>
                        
                        <p class="card-text"><?=$newLivre["Prix"]?> €</p>
                <?php 
                  }
                ?>
                </div>

              <div class="card-footer hide"  >
                <a href="pageProduit.php?idLivre=<?=$newLivre["idLivre"]?>"> <button  class="btn btn-success">Voir le produit</button></a> 
              </div>

          </div>
          <?php
          }
          ?>
      </div>
  </div>
</div>    
<?php
require_once 'pied.php';