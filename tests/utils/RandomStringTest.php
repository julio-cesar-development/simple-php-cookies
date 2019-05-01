<?php
declare (strict_types = 1);

require_once('./utils/RandomString.php');
use PHPUnit\Framework\TestCase;

final class RandomStringTest extends TestCase
{
  /**
   * @test
   * @group string
   */
  public function SizeOfString(): void
  {
    $size = 20;
    $this->assertSame(
      $size,
      strlen(RandomString::generate($size))
    );
  }

}

// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php tests\utils\RandomStringTest.php
// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php --testdox tests\utils\RandomStringTest.php

// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php --testdox tests\

// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php tests\ --group string
// vendor\bin\phpunit.bat --bootstrap vendor\autoload.php --testdox tests\ --group string
