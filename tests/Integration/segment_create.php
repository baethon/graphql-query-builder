<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::mutation(Gql::arguments(['$name' => 'String!', '$query' => 'String!']), [
    ['segmentCreate', Gql::arguments(['name' => '$name', 'query' => '$query']), [
        ['segment', [
            'id',
        ]],
        ['userErrors', [
            'field',
            'message',
        ]],
    ]],
]);
