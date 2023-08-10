<?php

use Baethon\Graphql\Builder\Templates\EmptySelector;

it('renders empty string', function (Closure $modifier) {
    $selector = new EmptySelector;
    $modifier($selector);

    expect((string) $selector)->toEqual('');
})->with([
    fn (EmptySelector $selector) => $selector->setSelectors(['foo']),
    fn (EmptySelector $selector) => $selector->setArguments(['foo' => 1]),
    fn (EmptySelector $selector) => $selector->setAlias('test'),
]);
