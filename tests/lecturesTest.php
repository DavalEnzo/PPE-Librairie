<?php

require_once "modeleTest.php";

require_once "modeles/lectures.php";

use PHPUnit\Framework\TestCase;

class lecturesTest extends TestCase
{
    
    public function testLectureConstruct()
    {
        $Lecture = new Lecture(23);
        
        $this->assertInstanceOf(Lecture::class, $Lecture);
        $this->assertIsObject($Lecture);
        $this->assertEquals(23, $Lecture->getIdLivre());
        $this->assertEquals(1, $Lecture->getIdLecture());
        $this->assertFileExists('membres/'.$Lecture->getContenu());

    }
}