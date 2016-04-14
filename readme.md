## Sugared\PHP-CS-Fixer [![Build Status](https://travis-ci.org/schnittstabil/sugared-php-cs-fixer.svg?branch=master)](https://travis-ci.org/schnittstabil/sugared-php-cs-fixer) [![Coverage Status](https://coveralls.io/repos/schnittstabil/sugared-php-cs-fixer/badge.svg?branch=master&service=github)](https://coveralls.io/github/schnittstabil/sugared-php-cs-fixer?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/schnittstabil/sugared-php-cs-fixer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/schnittstabil/sugared-php-cs-fixer/?branch=master) [![Code Climate](https://codeclimate.com/github/schnittstabil/sugared-php-cs-fixer/badges/gpa.svg)](https://codeclimate.com/github/schnittstabil/sugared-php-cs-fixer)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e1dbc6dc-f3c1-455f-9eb3-69158943ba65/big.png)](https://insight.sensiolabs.com/projects/e1dbc6dc-f3c1-455f-9eb3-69158943ba65)

> PHP-CS-Fixer sweetened with ease :cherries:

Sugared\PHP-CS-Fixer takes an opinionated view of code style checking with [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer), it is preconfigured to get you up and running as quickly as possible.

### Install

```
$ composer require --dev schnittstabil/sugared-php-cs-fixer
```

### Usage

Instead of running `php-cs-fixer` with all its options, just run `sugared-php-cs-fixer` - that's it:

```json
{
    ...
    "require-dev": {
        "schnittstabil/sugared-php-cs-fixer": ...
    },
    "scripts": {
        "lint": "sugared-php-cs-fixer"
    }
}
```

### Configuration

You may overwrite some options by putting it in your `composer.json`.

Some of the default settings:
```json
{
    ...
    "scripts": {
        "lint": "sugared-php-cs-fixer"
    },
    "extra": {
        "schnittstabil\/sugared-php-cs-fixer": {
            "diff": true,
            "dry-run": true,
            "cache": true,
            "path": {
                "in": [
                    "."
                ],
                "name": [
                    "*.php",
                    "*.phtml",
                    "*.twig",
                    "*.xml",
                    "*.yml"
                ],
                "exclude": [
                    "build",
                    "bower_components",
                    "node_modules",
                    "vendor"
                ],
                "ignoreDotFiles": true,
                "ignoreVCS": true
            }
        }
    }
}
```

### License

MIT © [Michael Mayer](http://schnittstabil.de)
