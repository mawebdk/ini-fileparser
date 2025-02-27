# ini-fileparser
IniFileParser is a simple INI file parser.

## Usage
```
try {
    $array = IniFileParser::getSingleton()->parseIniFile(filename: $filename);
} catch (IniFileParserException $e) {
    // Error handling.
}
```