<?php
declare (strict_types = 1);

require_once('./utils/RandomString.php');
use PHPUnit\Framework\TestCase;

final class RandomStringTest extends TestCase {
  /**
   * @test
   * @group string
   */
  public function sizeOfString(): void {
    $size = 20;
    $this->assertSame(
      $size,
      strlen(RandomString::generate($size))
    );
  }
}

