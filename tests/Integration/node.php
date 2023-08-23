<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::query([
    ['node', Gql::arguments(['id' => 'gid://shopify/Product/108828309']), [
        'id',
        [Gql::inline('Product'), [
            'title',
            'handle',
        ]],
    ]],
]);
