<?php

use Symfony\Component\Finder\Finder;

$finder = (Finder::create())
    ->in(__DIR__)
    ->name('*.gql')
    ->files();

foreach ($finder as $item) {
    $query = require __DIR__.'/'.$item->getFilenameWithoutExtension().'.php';

    test($item->getBasename(), function () use ($item, $query) {
        $expected = preg_replace(
            "/^\s+/m",
            '',
            trim($item->getContents()),
        );

        $actual = trim((string) $query);

        expect($actual)->toEqual($expected);
    })->skip(is_null($query), 'Missing implementation');
}
