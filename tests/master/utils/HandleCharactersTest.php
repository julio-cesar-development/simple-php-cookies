<?php
declare (strict_types = 1);

require_once('./utils/HandleCharacters.php');
use PHPUnit\Framework\TestCase;

final class HandleCharactersTest extends TestCase {
  /**
   * @test
   * @group characters
   */
  public function sqlWorks(): void {
    $this->assertEquals(
      '()test',
      HandleCharacters::ant_sql('select * from ? ; +-#$@%&*!()test')
    );
  }

  /**
   * @test
   * @group characters
   */
  public function sqlWorksForPasswords(): void {
    $this->assertEquals(
      '*?;+-#$@%&*!()test',
      HandleCharacters::ant_sql_pass('select * from ? ; +-#$@%&*!()test')
    );
  }

  /**
   * @test
   * @group characters
   */
  public function replaceCharacters(): void {
    $this->assertEquals(
      '&atilde;&otilde;&ccedil;&aacute;&eacute;&iacute;&oacute;&uacute;&ecirc;&ocirc;&ntilde;&ucirc;&agrave;&egrave;&igrave;&ograve;&ugrave;&icirc;',
      HandleCharacters::replace_characters('ãõçáéíóúêôñûàèìòùî')
    );
  }
}
