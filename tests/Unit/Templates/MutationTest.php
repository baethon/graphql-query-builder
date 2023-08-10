<?php

use Baethon\Graphql\Builder\Builder;
use Baethon\Graphql\Builder\Templates\Mutation;

$pipeline = fn (callable ...$fns) => array_reduce(
    $fns,
    fn (Mutation $query, callable $fn) => $fn($query),
    new Mutation,
);

it('builds a query', function (Mutation $mutation, string $expected) {
    expect((string) $mutation)->toEqual($expected);
})->with([
    'empty mutation' => [
        $pipeline(),
        "mutation {\n}",
    ],
    'mutation with arguments' => [
        $pipeline(
            Builder::arguments(['ids' => '[ID!]!']),
        ),
        "mutation(ids: [ID!]!) {\n}",
    ],
    'mutation with nested fields' => [
        $pipeline(
            Builder::select(['firstName']),
        ),
        "mutation {\nfirstName\n}",
    ],
    'mutation with nested fields and arguments' => [
        $pipeline(
            Builder::arguments(['ids' => '[ID!]!']),
            Builder::select(['firstName']),
        ),
        "mutation(ids: [ID!]!) {\nfirstName\n}",
    ],
]);
