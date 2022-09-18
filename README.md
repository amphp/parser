# amphp/parser

AMPHP is a collection of event-driven libraries for PHP designed with fibers and concurrency in mind.
`amphp/parser` allows easily building streaming generator parsers.

[![Release](https://img.shields.io/github/release/amphp/parser.svg?style=flat-square)](https://github.com/amphp/parser/releases)
![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)

## Installation

This package can be installed as a [Composer](https://getcomposer.org/) dependency.

```bash
composer require amphp/parser
```

## Requirements

- PHP 7.0+

## Usage

PHP's generators are a great way for building incremental parsers.

## Example

This simple parser parses a line delimited protocol and prints a message for each line. Instead of printing a message, you could also invoke a data callback.

```php
$parser = new Parser((function () {
    while (true) {
        $line = yield "\r\n";

        if (trim($line) === "") {
            continue;
        }

        print "New item: {$line}" . PHP_EOL;
    }
})());

for ($i = 0; $i < 100; $i++) {
    $parser->push("bar\r");
    $parser->push("\nfoo");
}
```

## Yield Behavior

You can either `yield` a `string` that's used as delimiter, an `integer` that's used as length, or `null` for consuming everything that's available.

## Versioning

`amphp/parser` follows the [semver](http://semver.org/) semantic versioning specification like all other `amphp` packages.

## Security

If you discover any security related issues, please email [`me@kelunik.com`](mailto:me@kelunik.com) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [`LICENSE`](./LICENSE) for more information.
