<?php

require_once "modeleTest.php";

require_once "modeles/Livre.php";

require_once "modeles/Commentaire.php";

require_once "modeles/Auteur.php";

require_once "modeles/Utilisateur.php";

require_once "modeles/lectures.php";

require_once "modeles/Editeur.php";

use PHPUnit\Framework\TestCase;

class livreTest extends TestCase
{
    
    public function testLivreConstruct()
    {
        $Livre = new Livre(1);
        
        $this->assertInstanceOf(Livre::class, $Livre);
        $this->assertIsObject($Livre);
        $this->assertEquals(1, $Livre->getidLivre());
        $this->assertIsString($Livre->getTitre());
        $this->assertEquals("T'inquiète pas , maman, ça va aller", $Livre->getTitre());
        $this->assertIsString($Livre->getdate_sortie());
        $this->assertEquals("24-02-2021", $Livre->getdate_sortie());
        $this->assertEquals(18,$Livre->getPrix());
        $this->assertIsString("https://static.fnac-static.com/multimedia/Images/FR/NR/f4/ab/c2/12758004/1507-1/tsp20210218115248/T-inquiete-pas-maman-ca-va-aller.jpg", $Livre->getPhoto());
        $this->assertEquals(1, $Livre->getidGenre());
        $this->assertEquals(1, $Livre->getidTypeGenre());
        $this->assertEquals(1, $Livre->getidEditeur());
        $this->assertEquals("2021-03-04 16:40:34" ,$Livre->getdate_heure());
        $this->assertEquals(0 ,$Livre->getdroit());

    }

    public function testInsertLivre()
    {
        $Livre = new Livre();

        $modele = new Modele();

        $Livre->initialize(null, "T'inquiète pas , maman, ça va aller", "24-02-2021", 18, "https://static.fnac-static.com/multimedia/Images/FR/NR/f4/ab/c2/12758004/1507-1/tsp20210218115248/T-inquiete-pas-maman-ca-va-aller.jpg", 1, 1, 1, null, 0);

        $this->assertInstanceOf(Livre::class, $Livre);

        $this->assertTrue($Livre->insertLivre());

        $requete=$modele->getBdd()->prepare("DELETE FROM livres WHERE idLivre = (SELECT MAX(idLivre) FROM (SELECT * FROM livres) AS livres)"); 
        $requete->execute();

    }
}