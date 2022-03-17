<?php

require_once "modeleTest.php";

require_once "modeles/Editeur.php";

require_once "modeles/Livre.php";

require_once "modeles/Auteur.php";

use PHPUnit\Framework\TestCase;

class editeurTest extends TestCase
{
    
    public function testEditeurConstruct()
    {
        $Editeur = new Editeur(1);
        
        $this->assertInstanceOf(Editeur::class, $Editeur);
        $this->assertIsObject($Editeur);
        $this->assertIsString($Editeur->getNomEditeur());
        $this->assertEquals("Fayard" ,$Editeur->getNomEditeur());
        $this->assertEquals(1 ,$Editeur->getIdEditeur());

    }

    public function testInitLivreEditeur()
    {
        $Editeur = new Editeur();

        $Editeur->initLivreEditeur(1);

        $this->assertInstanceOf(Editeur::class, $Editeur);
        $this->assertIsObject($Editeur);
        $this->assertIsArray($Editeur->getLivre());
    }

    
    public function testInsertEditeur()
    {
        $Editeur = new Editeur();

        $modele = new Modele();

        $this->assertTrue($Editeur->insertEditeur("Fayard"));

        $requete=$modele->getBdd()->prepare("DELETE FROM editeurs WHERE idEditeur = (SELECT MAX(idEditeur) FROM (SELECT * FROM editeurs) AS editeurs)"); 
        $requete->execute();
    }
}