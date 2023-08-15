<?php

use Baethon\Graphql\Builder\Builder;
use Baethon\Graphql\Builder\Templates\Query;

$pipeline = fn (callable ...$fns) => array_reduce(
    $fns,
    fn (Query $query, callable $fn) => $fn($query),
    new Query,
);

it('builds a query', function (Query $query, string $expected) {
    expect((string) $query)->toEqual($expected);
})->with([
    'empty query' => [
        $pipeline(),
        "query {\n}",
    ],
    'query with arguments' => [
        $pipeline(
            Builder::arguments(['$ids' => '[ID!]!']),
        ),
        "query(\$ids: [ID!]!) {\n}",
    ],
    'query with nested fields' => [
        $pipeline(
            Builder::select(['firstName']),
        ),
        "query {\nfirstName\n}",
    ],
    'query with nested fields and arguments' => [
        $pipeline(
            Builder::arguments(['$ids' => '[ID!]!']),
            Builder::select(['firstName']),
        ),
        "query(\$ids: [ID!]!) {\nfirstName\n}",
    ],
]);
