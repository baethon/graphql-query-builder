<?php

use Baethon\Graphql\Builder\Builder;
use Baethon\Graphql\Builder\Templates\NestedSelector;

it('renders nested fields', function (array $fields, string $expected) {
    $selector = new NestedSelector;
    $selector->setSelectors($fields);

    expect((string) $selector)->toEqual($expected);
})->with([
    'simple fields' => [
        [
            'firstName',
            'lastName',
            ['age'],
        ],
        "{\nfirstName\nlastName\nage\n}",
    ],
    'nested selectors' => [
        [
            ['customer', [
                'id',
            ]],
        ],
        "{\ncustomer {\nid\n}\n}",
    ],
    'nested nested selectors' => [
        [
            ['customers', Builder::arguments(['id' => 1]), [
                ['orders', [
                    'id',
                ]],
            ]],
        ],
        "{\ncustomers(id: 1) {\norders {\nid\n}\n}\n}",
    ],
]);
