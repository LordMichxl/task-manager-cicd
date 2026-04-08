<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// Dossiers à analyser
$finder = Finder::create()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/database')
    ->in(__DIR__ . '/routes')
    ->in(__DIR__ . '/tests');

return Config::create()
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
    ])
    ->setFinder($finder);
