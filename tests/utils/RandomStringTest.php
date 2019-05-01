<?php
declare (strict_types = 1);

require_once('./utils/RandomString.php');
use PHPUnit\Framework\TestCase;

final class RandomStringTest extends TestCase
{
  /**
   * @test
   * @group characters
   */
  public function SqlWorks(): void
  {
    $this->assertEquals(
      '()test',
      HandleCharacters::ant_sql('select * from ? ; +-#$@%&*!()test')
    );
  }

}

// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php tests\utils\RandomStringTest.php
// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php --testdox tests\utils\RandomStringTest.php

// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php --testdox tests\

// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php tests\ --group characters
// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php --testdox tests\ --group characters
