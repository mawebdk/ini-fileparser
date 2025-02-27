<?php
namespace App\Test\IniFileParser;

use MawebDK\IniFileParser\IniFileParser;
use MawebDK\IniFileParser\IniFileParserException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class IniFileParserTest extends TestCase
{
    /**
     * @throws IniFileParserException
     */
    #[DataProvider('dataProviderParseIniFile')]
    public function testParseIniFile(string $filename, array $expectedResult)
    {
        $this->assertSame(
            expected: $expectedResult,
            actual: IniFileParser::getSingleton()->parseIniFile(filename: $filename)
        );
    }

    public static function dataProviderParseIniFile(): array
    {
        return [
            'Empty INI file' => [
                'filename'       => __DIR__ . '/testFiles/Empty.ini',
                'expectedResult' => [],
            ],
            'Sample INI file' => [
                'filename'       => __DIR__ . '/testFiles/Sample.ini',
                'expectedResult' => [
                    'string'       => 'String value',
                    'integerMin'   => -9223372036854775807,
                    'integerMax'   => 9223372036854775807,
                    'booleanTrue'  => true,
                    'booleanFalse' => false,
                ]
            ]
        ];
    }

    public function testParseIniFile_IniFileParserException_FileNotFound()
    {
        $filename = __DIR__ . '/testFiles/Unknown.ini';

        $this->expectException(exception: IniFileParserException::class);
        $this->expectExceptionMessage(message: sprintf('INI file "%s" does not exist.', $filename));

        IniFileParser::getSingleton()->parseIniFile(filename: $filename);
    }

    public function testParseIniFile_IniFileParserException_InvalidContents()
    {
        $filename = __DIR__ . '/testFiles/Invalid.ini';

        $this->expectException(exception: IniFileParserException::class);
        $this->expectExceptionMessage(message: sprintf('Failed to parse INI file "%s".', $filename));

        IniFileParser::getSingleton()->parseIniFile(filename: $filename);
    }
}
