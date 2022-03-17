<?php
require_once "modeleTest.php";

require_once "modeles/Bibliotheque.php";

require_once "modeles/Livre.php";

require_once "modeles/Auteur.php";

require_once "modeles/Genre.php";

require_once "modeles/typeGenre.php";

require_once "modeles/Editeur.php";


use PHPUnit\Framework\TestCase;

class bibliothequeTest extends TestCase
{
    public function testBibliothequeConstruct()
    {
        $Bibliotheque = new Bibliotheque();
        
        $this->assertInstanceOf(Bibliotheque::class, $Bibliotheque);
        $this->assertIsObject($Bibliotheque);
        $this->assertIsArray($Bibliotheque->getLivres());
        $this->assertIsArray($Bibliotheque->getGenres());
        $this->assertIsArray($Bibliotheque->getAuteurs());
        $this->assertIsArray($Bibliotheque->getEditeurs());

    }
}