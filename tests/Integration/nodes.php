<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::query([
    ['nodes', Gql::arguments(['ids' => ['gid://shopify/Product/108828309', 'gid://shopify/GiftCard/924862292', 'gid://shopify/Collection/142458073']]), [
        'id',
        [Gql::inline('Product'), [
            'title',
        ]],
        [Gql::inline('GiftCard'), [
            ['balance', [
                'amount',
                'currencyCode',
            ]],
        ]],
        [Gql::inline('Collection'), [
            'sortOrder',
        ]],
    ]],
]);
