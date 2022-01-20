<?php
require_once 'entete.php';
$Bibli=new Bibliotheque();

$livres = $Bibli->getToutLivres();
?>
              <div class="m-1 text-dark text-center MomentBG"
              data-aos="fade-down"
              data-aos-duration="3000"
              >
                <h1 class="textColor MomentBG" >Des livres a n'importe quel moment où que vous soyez</h1>
              </div>
    <div class="container white">  
        <div style="border-radius: 30px;" class="p-1 mb-2 text-center BackGround"
                data-aos="fade-right"
                data-aos-duration="3000">
          <h2 class="textColor hShadow">Livres à la une</h2>
        </div>
        
          <section id="slick"
                data-aos="fade-down"
                data-aos-duration="3000"
                style="width: auto; height:auto";
                >
                <div class="container">
                            <div class="row">
                              
                                   <div class="col arrow_next"> 
                                      <span>
                                        <i class="fas fa-3x fa-angle-double-right"></i>
                                      </span>
                                      
                                    </div>
                                <div class="slick-content col">
                                    <?php
                                    foreach($livres as $livre){
                                      ?>
                                      <div class="slider_items">
                                        <a href="pageProduit.php?idLivre=<?=$livre["idLivre"]?>">
                                          <img class="imgslide mx-1" src="<?=$livre["Photo"]?>" >
                                          </a>
                                      </div>
                                      <?php
                                    }
                                    ?>
                                </div>
                                  <div class="arrow_prev col"> 
                                    <span >
                                    <i class="fas fa-3x fa-angle-double-left"></i>
                                    </span>
                                    
                                  </div>
                              </div>
                            
                </div>
          </section>

          <div     style="border-radius:30px"
                    class="BackGround pb-1"
                    data-aos="fade-left"
                    data-aos-duration="3000">
            <h1 class="text-center my-3 stext"
            
                  style="color:white;" 
            >Les Nouveautés :</h1>
          </div>
        <div class="card-group" style='margin:1rem;'
                data-aos="fade-down"
                data-aos-duration="3000" >
          <?php
          $newLivres = $Bibli->getNewLivres();
          foreach($newLivres as $newLivre){  
            ?>
        <a class="decoNone" href="pageProduit.php?idLivre=<?=$newLivre["idLivre"]?>">
          <div  class="card mx-3 my-5 cardlivre"
               
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none;" >

                <img  class="card-img-top imgCard" style="max-height:340px;" src="<?=$newLivre["Photo"]?>">

                <div class="card-body" style="min-height:105px;" id="card" >
                    <h8 class="card-title"><?=$newLivre["Titre"]?></h8>
                    <?php
                    if($newLivre['Prix']== 0.00){
                        ?>
                        <p><strong>Libre de droit</strong></p>
                    <?php
                    }else{
                        ?>
                        
                        <p class="card-text"><strong><?=$newLivre["Prix"]?> €</strong></p>
                <?php 
                  }
                ?>
                </div>
        </a>         

          </div>
          <?php
          }
          ?>
      </div>
</div>   
<?php
require_once 'pied.php';