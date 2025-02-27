<?php
namespace MawebDK\IniFileParser;

/**
 * Interface with IniFileParser methods.
 */
interface IniFileParserInterface
{
    /**
     * Parse an INI configuration file and return the configurations as an associative array.
     * @param string $filename          Filename of the INI file being parsed.
     * @return array                    Configurations as an associative array.
     * @throws IniFileParserException   Failed to parse INI configuration file.
     */
    public function parseIniFile(string $filename): array;
}