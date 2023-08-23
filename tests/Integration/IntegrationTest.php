<?php

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

$finder = (Finder::create())
    ->in(__DIR__)
    ->name('*.gql')
    ->files();

$dataset = array_reduce(
    iterator_to_array($finder),
    function ($carry, SplFileInfo $item) {
        return [
            ...$carry,
            $item->getBasename() => $item,
        ];
    },
    []
);

it('generates query', function (SplFileInfo $item) {
    $query = require __DIR__.'/'.$item->getFilenameWithoutExtension().'.php';
    $expected = preg_replace(
        "/^\s+/m",
        '',
        trim($item->getContents()),
    );

    $actual = trim((string) $query);

    expect($actual)->toEqual($expected);
})->with($dataset);
