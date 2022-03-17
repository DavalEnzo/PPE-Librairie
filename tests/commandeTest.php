<?php
require_once "modeleTest.php";

require_once "modeles/Commande.php";

require_once "modeles/Panier.php";


use PHPUnit\Framework\TestCase;

class commandeTest extends TestCase
{
    public function testCommandeConstruct()
    {
        $Commmande = new Commande(1);
        
        $this->assertInstanceOf(Commande::class, $Commmande);
        $this->assertIsObject($Commmande);
        $this->assertEquals(1, $Commmande->getIdCommande());
        $this->assertEquals(13, $Commmande->getIdPanier());
        $this->assertEquals(1, $Commmande->getIdutilisateur());
        $this->assertEquals(80, $Commmande->getPrixTotal());
        $this->assertEquals(1, $Commmande->getIdAdresse());
        $this->assertIsString($Commmande->getDateCommande());
        $this->assertEquals(0, $Commmande->getStatut());
        $this->assertIsObject($Commmande->getPanier());

    }

    public function testAjouterCommande()
    {
        $Commmande = new Commande();

        $modele = new Modele();

        $this->assertTrue($Commmande->ajouterCommande(1, 1, 75.5, 1));

        $requete=$modele->getBdd()->prepare("DELETE FROM commandes WHERE idCommande = (SELECT MAX(idCommande) FROM (SELECT * FROM commandes) AS commandes)"); 
        $requete->execute();

    }

    public function testAjouterDetailsCommande()
    {
        $Commmande = new Commande();

        $modele = new Modele();

        $this->assertTrue($Commmande->ajouterDetailsCommande(1, 5));

        $requete=$modele->getBdd()->prepare("DELETE FROM detailcommandes WHERE idDetailCommande = (SELECT MAX(idDetailCommande) FROM (SELECT * FROM detailcommandes) AS detailcommandes)"); 
        $requete->execute();

    }
}