# Minicli

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JesusValera/minicli/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/JesusValera/minicli/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/JesusValera/minicli/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/JesusValera/minicli/?branch=master)
[![Type Coverage](https://shepherd.dev/github/JesusValera/minicli/coverage.svg)](https://shepherd.dev/github/JesusValera/minicli)
[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg?style=flat-square)](https://php.net/)

Simple PHP CLI (Command Line Interface).

#### Minicli commands:
- _./minicli {help}_ -> display help command
- _./minicli hello {world}_ -> display "Hello {world}" message
- _./minicli {whatever}_ -> display an error message

#### Some make tasks to execute commands inside the docker container such:
- _make bash_ -> access into the bash
- _make csfix_ -> run the code style fixer (.php_cs)
- _make composer ARGS="require phpunit/phpunit"_ -> run composer
- _make tests ARGS="--filter AppTest"_ -> run PHPUnit


src: https://dev.to/erikaheidi/bootstrapping-a-cli-php-application-in-vanilla-php-4ee

> Thank you so much @erikaheidi :)