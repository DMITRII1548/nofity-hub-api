<?php

$finder = (new PhpCsFixer\Finder())
    ->exclude([
        'bin',
        'vendor',
        '.phpunit.cache',
        'var',
        'vendor'
    ])
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        'declare_strict_types' => true
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
