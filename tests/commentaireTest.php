<?php
require_once "modeleTest.php";

require_once "modeles/commentaire.php";

require_once "modeles/utilisateur.php";

use PHPUnit\Framework\TestCase;

class commentaireTest extends TestCase
{
    public function testCommentaireConstruct()
    {
        $Commentaire = new Commentaire(1);
        
        $this->assertInstanceOf(Commentaire::class, $Commentaire);
        $this->assertIsObject($Commentaire);
        $this->assertEquals(1, $Commentaire->getIdCom());
        $this->assertIsString($Commentaire->getEntete());
        $this->assertEquals("Je suis pas content !", $Commentaire->getEntete());
        $this->assertIsString($Commentaire->getContenu());
        $this->assertEquals("erezrtzergzerg", $Commentaire->getContenu());
        $this->assertEquals(1, $Commentaire->getIdUtilisateur());
        $this->assertEquals(1, $Commentaire->getIdLivre());
        $this->assertEquals(4, $Commentaire->getGrade());
        $this->assertIsString($Commentaire->getDateHeure());
        $this->assertEquals("2021-03-05 12:39:32", $Commentaire->getDateHeure());
        $this->assertIsObject($Commentaire->getUtilisateur());      

    }
    
    public function testInsertCom()
    {
        $Commentaire = new Commentaire();

        $modele = new Modele();

        $Commentaire->initializeCom(NULL,'Du contenu', 1, 1, 5, 'Un titre',NULL,true);

        $this->assertTrue($Commentaire->insertCom(1, 5));

        $requete=$modele->getBdd()->prepare("DELETE FROM commentaires WHERE idCommentaire = (SELECT MAX(idCommentaire) FROM (SELECT * FROM commentaires) AS commentaires)"); 
        $requete->execute();

    }
}