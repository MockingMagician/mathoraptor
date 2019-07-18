#!/usr/bin/env php
<?php

$author = '@author Marc MOREAU <moreau.marc.web@gmail.com>';
$license = '@license https://github.com/MockingMagician/mathoraptor/blob/master/LICENSE.md Apache License 2.0';
$link = '@link https://github.com/MockingMagician/mathoraptor/blob/master/README.md';

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->filter(static function (SplFileInfo $fileInfo) {
        if (preg_match('/Interface\.php$/', $fileInfo->getFilename())) {
            return false;
        }

        return true;
    })
    ->in(__DIR__)
;

$config = PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP71Migration:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'self_accessor' => false,
        'php_unit_strict' => false,
        'yoda_style' => true,
        'native_function_invocation' => [
            'include' => [
                '@internal',
            ],
        ],
        'header_comment' => [
            'header' => implode("\n", [$author, $license, $link]),
            'comment_type' => 'PHPDoc',
        ],
    ])
    ->setFinder($finder)
;

return $config;
