<?php

use Baethon\Graphql\Builder\Builder;
use Baethon\Graphql\Builder\Templates\InlineSelector;

it('renders nested fields', function (array $fields, string $expected) {
    $selector = new InlineSelector('Product');
    $selector->setSelectors($fields);

    expect((string) $selector)->toEqual($expected);
})->with([
    'simple fields' => [
        [
            'firstName',
            'lastName',
            ['age'],
        ],
        "... on Product {\nfirstName\nlastName\nage\n}",
    ],
    'nested selectors' => [
        [
            ['customer', [
                'id',
            ]],
        ],
        "... on Product {\ncustomer {\nid\n}\n}",
    ],
    'nested nested selectors' => [
        [
            ['customers', Builder::arguments(['id' => 1]), [
                ['orders', [
                    'id',
                ]],
            ]],
        ],
        "... on Product {\ncustomers(id: 1) {\norders {\nid\n}\n}\n}",
    ],
]);
