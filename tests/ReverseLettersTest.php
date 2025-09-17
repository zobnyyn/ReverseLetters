<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/ReverseLetters.php';

class ReverseLettersTest extends TestCase
{
    public function testBasicExamples(): void
    {
        $this->assertEquals('Tac', ReverseLetters::reverse('Cat'));
        $this->assertEquals('Ьшым', ReverseLetters::reverse('Мышь'));
        $this->assertEquals('esuOh', ReverseLetters::reverse('houSe'));
        $this->assertEquals('кимОД', ReverseLetters::reverse('домИК'));
        $this->assertEquals('tnAhPele', ReverseLetters::reverse('elEpHant'));
    }

    public function testPunctuationAndQuotes(): void
    {
        $this->assertEquals('tac,', ReverseLetters::reverse('cat,'));
        $this->assertEquals('Амиз:', ReverseLetters::reverse('Зима:'));
        $this->assertEquals("si 'dloc' won", ReverseLetters::reverse("is 'cold' now"));
        $this->assertEquals('отэ «Кат» "отсорп"', ReverseLetters::reverse('это «Так» "просто"'));
    }

    public function testHyphenAndApostrophe(): void
    {
        $this->assertEquals('driht-trap', ReverseLetters::reverse('third-part'));
        $this->assertEquals('nac`t', ReverseLetters::reverse("can`t"));
        $this->assertEquals("nac't", ReverseLetters::reverse("can't"));
    }

    public function testEdgeCases(): void
    {
        $this->assertEquals('', ReverseLetters::reverse(''));
        $this->assertEquals('1234,.-', ReverseLetters::reverse('1234,.-'));
        $this->assertEquals('A', ReverseLetters::reverse('A'));
        $this->assertEquals('Ba', ReverseLetters::reverse('Ab'));
    }
}
