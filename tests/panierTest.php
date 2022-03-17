<?php

require_once "modeleTest.php";

require_once "modeles/Panier.php";

use PHPUnit\Framework\TestCase;

class panierTest extends TestCase
{
    
    public function testPanierConstruct()
    {
        $Panier = new Panier(1);
        
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
}