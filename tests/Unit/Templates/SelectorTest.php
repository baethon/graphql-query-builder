<?php

use function Baethon\Graphql\Builder\tap;
use Baethon\Graphql\Builder\Templates\Selector;

$pipeline = fn (Selector $selector, callable ...$fns) => array_reduce(
    $fns,
    fn (Selector $selector, callable $fn) => tap($selector, $fn),
    $selector,
);

it('builds a selector', function (Selector $selector, string $expected) {
    expect((string) $selector)->toEqual($expected);
})->with([
    [
        $pipeline(new Selector('test')),
        'test',
    ],
    [
        $pipeline(
            new Selector('test'),
            fn (Selector $selector) => $selector->setAlias('foo'),
        ),
        'foo: test',
    ],
    [
        $pipeline(
            new Selector('test'),
            fn (Selector $selector) => $selector->setArguments(['skip' => 1]),
        ),
        'test(skip: 1)',
    ],
    [
        $pipeline(
            new Selector('test'),
            fn (Selector $selector) => $selector->setAlias('foo'),
            fn (Selector $selector) => $selector->setArguments(['skip' => 1]),
        ),
        'foo: test(skip: 1)',
    ],
    /* [ */
    /*     $pipeline( */
    /*         new Selector('test'), */
    /*         fn (Selector $selector) => $selector->setSelectors(['name']), */
    /*     ), */
    /*     <<<'QUERY' */
    /*         test { */
    /*             name */
    /*         } */
    /*     QUERY, */
    /* ], */
]);
