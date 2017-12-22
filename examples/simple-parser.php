<?php

require __DIR__ . "/../vendor/autoload.php";

use Amp\Parser\Parser;

// Defines a generator that yields integers (number of bytes to read), strings (delimiter to search for), or
// null (read any amount of bytes).
$generator = function (callable $printer): \Generator {
    while (true) {
        $buffer = yield "\n"; // Reads until a new-line character is found.
        $printer($buffer); // Use the received data.
    }
};

// The user of Parser is responsible for creating the Generator object, allowing anything to be passed into the
// generator that may be required.
$parser = new Parser($generator(function (string $parsedData) {
    static $i = 0;
    printf("[%d] %s\n", $i++, $parsedData);
}));

$parser->push("This\nis\n");
$parser->push("an\nexample\nof\n");
$parser->push("a\nsimple\n");
$parser->push("incremental\nstream\nparser\n");
