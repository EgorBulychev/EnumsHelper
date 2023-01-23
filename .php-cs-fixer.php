<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setFinder(
        PhpCsFixer\Finder::create()->in([
            __DIR__ . '/src',
            __DIR__ . '/tests',
        ])
        ->append([
            __FILE__,
        ])
    )->setRules([
        '@PSR12' => true,
    ]);
