## SugaredRim\PHP-CS-Fixer [![Build Status](https://travis-ci.org/sugared-rim/php-cs-fixer.svg?branch=master)](https://travis-ci.org/sugared-rim/php-cs-fixer) [![Coverage Status](https://coveralls.io/repos/sugared-rim/php-cs-fixer/badge.svg?branch=master&service=github)](https://coveralls.io/github/sugared-rim/php-cs-fixer?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sugared-rim/php-cs-fixer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sugared-rim/php-cs-fixer/?branch=master) [![Code Climate](https://codeclimate.com/github/sugared-rim/php-cs-fixer/badges/gpa.svg)](https://codeclimate.com/github/sugared-rim/php-cs-fixer)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/905fb88b-2be4-42ba-b383-58b08ce68463/big.png)](https://insight.sensiolabs.com/projects/905fb88b-2be4-42ba-b383-58b08ce68463)

> PHP-CS-Fixer sweetened with ease :cherries:

SugaredRim\PHP-CS-Fixer takes an opinionated view of code style checking with [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer), it is preconfigured to get you up and running as quickly as possible.

### Install

```
$ composer require --dev sugared-rim/php-cs-fixer
```

### Usage

Instead of running `php-cs-fixer` with all its options, just run `sugared-rim-php-cs-fixer` - that's it:

```json
{
    ...
    "require-dev": {
        "sugared-rim/php-cs-fixer": ...
    },
    "scripts": {
        "lint": "sugared-rim-php-cs-fixer"
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
        "lint": "sugared-rim-php-cs-fixer"
    },
    "extra": {
        "sugared-rim/php-cs-fixer": {
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
