<?php

require_once "modeleTest.php";

require_once "modeles/Genre.php";

require_once "modeles/typeGenre.php";

use PHPUnit\Framework\TestCase;

class genreTest extends TestCase
{
    
    public function testGenreConstruct()
    {
        $Genre = new Genre(12);
        
        $this->assertInstanceOf(Genre::class, $Genre);
        $this->assertIsObject($Genre);
        $this->assertEquals(12, $Genre->getIdGenre());
        $this->assertIsString($Genre->getNomGenre());
        $this->assertEquals("Théâtrale" ,$Genre->getNomGenre());
        $this->assertFileExists('membres/'.$Genre->getImgGenre());
    }
    
    public function testInitTypeGenre()
    {
        $Genre = new Genre();
        
        $Genre->initTypeGenre(12);

        $this->assertInstanceOf(Genre::class, $Genre);
        $this->assertIsObject($Genre);
        $this->assertIsArray($Genre->getTypeGenre());
    }
    
    public function testInsertGenre()
    {
        $Genre = new Genre();

        $modele = new Modele();

        $this->assertInstanceOf(Genre::class, $Genre);
        $this->assertTrue($Genre->insertGenre('Narratifs'));

        $requete=$modele->getBdd()->prepare("DELETE FROM genres WHERE idGenre = (SELECT MAX(idGenre) FROM (SELECT * FROM genres) AS genres)"); 
        $requete->execute();
    }
    
    public function testInsertTypeGenre()
    {
        $Genre = new Genre();

        $modele = new Modele();

        $this->assertInstanceOf(Genre::class, $Genre);
        $this->assertTrue($Genre->insertTypegenre('roman', 11));

        $requete=$modele->getBdd()->prepare("DELETE FROM typegenre WHERE idtypeGenre = (SELECT MAX(idtypeGenre) FROM (SELECT * FROM typegenre) AS typegenre)"); 
        $requete->execute();
    }
}