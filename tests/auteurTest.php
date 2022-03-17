<?php
require_once "modeleTest.php";

require_once "modeles/Auteur.php";


use PHPUnit\Framework\TestCase;

class auteurTest extends TestCase
{
    public function testAuteurConstruct()
    {
        $Auteur = new Auteur(1);
        
        $this->assertInstanceOf(Auteur::class, $Auteur);
        $this->assertIsObject($Auteur);
        $this->assertIsInt($Auteur->getIdAuteur());
        $this->assertIsString($Auteur->getNomAuteur());
        $this->assertEquals("Hélène De Fougerolles" ,$Auteur->getNomAuteur());

    }

    public function testInitialize()
    {
        $Auteur = new Auteur();
        $Auteur->initialize(1, "Hélène De Fougerolles");

        $this->assertIsObject($Auteur);
        $this->assertInstanceOf(Auteur::class, $Auteur);
        $this->assertIsInt($Auteur->getIdAuteur());
        $this->assertIsString($Auteur->getNomAuteur());
        $this->assertEquals("Hélène De Fougerolles" ,$Auteur->getNomAuteur());
    }

    public function testInsertEcritSansAuteur()
    {
        $Auteur = new Auteur();

        $modele = new Modele();

        $this->assertIsObject($Auteur);
        $this->assertInstanceOf(Auteur::class, $Auteur);
        $this->assertTrue($Auteur->insertEcrit());

        $requete=$modele->getBdd()->prepare("DELETE FROM ecrit WHERE idEcrit = (SELECT MAX(idEcrit) FROM (SELECT * FROM ecrit) AS ecrit)"); 
        $requete->execute();
    }

    public function testInsertEcritAvecAuteur()
    {
        $Auteur = new Auteur();

        $modele = new Modele();

        $this->assertIsObject($Auteur);
        $this->assertInstanceOf(Auteur::class, $Auteur);
        $this->assertTrue($Auteur->insertEcrit(12));

        $requete=$modele->getBdd()->prepare("DELETE FROM ecrit WHERE idEcrit = (SELECT MAX(idEcrit) FROM (SELECT * FROM ecrit) AS ecrit)"); 
        $requete->execute();
    }

    public function testInsertAuteur()
    {
        $Auteur = new Auteur();

        $modele = new Modele();

        $this->assertIsObject($Auteur);
        $this->assertInstanceOf(Auteur::class, $Auteur);
        $Auteur->initialize(null, "Jean-Luc");

        $this->assertTrue($Auteur->insertAuteur());

        $requete=$modele->getBdd()->prepare("DELETE FROM ecrit WHERE idEcrit = (SELECT MAX(idEcrit) FROM (SELECT * FROM ecrit) AS ecrit)"); 
        $requete->execute();
    }

    public function testInsertAuteur2()
    {
        $Auteur = new Auteur();

        $modele = new Modele();

        $this->assertIsObject($Auteur);
        $this->assertInstanceOf(Auteur::class, $Auteur);
        $this->assertTrue($Auteur->insertAuteur2(1));

        $requete=$modele->getBdd()->prepare("DELETE FROM ecrit WHERE idEcrit = (SELECT MAX(idEcrit) FROM (SELECT * FROM ecrit) AS ecrit)"); 
        $requete->execute();
    }
}