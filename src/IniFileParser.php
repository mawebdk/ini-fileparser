<?php
namespace MawebDK\IniFileParser;

/**
 * Parse an INI configuration file.
 */
class IniFileParser implements IniFileParserInterface
{
    /**
     * @var IniFileParserInterface|null   Singleton instance to handle the IniFileParser requests.
     */
    private static ?IniFileParserInterface $singleton = null;

    /**
     * Returns the singleton instance to handle the IniFileParser requests.
     * @return IniFileParserInterface   Singleton instance to handle the IniFileParser requests.
     */
    public static function getSingleton(): IniFileParserInterface
    {
        if (is_null(self::$singleton)):
            self::$singleton = new self();
        endif;

        return self::$singleton;
    }

    /**
     * @inheritDoc
     */
    public function parseIniFile(string $filename): array
    {
        if (!file_exists(filename: $filename)):
            throw new IniFileParserException(message: sprintf('INI file "%s" does not exist.', $filename));
        endif;

        // Warnings from parse_ini_file() is intentionally suppressed.
        $array = @parse_ini_file(filename: $filename, scanner_mode: INI_SCANNER_TYPED);

        if (!is_array(value: $array)):
            throw new IniFileParserException(message: sprintf('Failed to parse INI file "%s".', $filename));
        endif;

        return $array;
    }
}