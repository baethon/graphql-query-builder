<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::query([
    ['returnableFulfillment', Gql::arguments(['id' => 'gid://shopify/ReturnableFulfillment/607470790']), [
        'id',
        ['fulfillment', [
            'id',
            'status',
        ]],
        ['returnableFulfillmentLineItems', Gql::arguments(['first' => 5]), [
            ['edges', [
                ['node', [
                    'quantity',
                    ['fulfillmentLineItem', [
                        'id',
                        ['lineItem', [
                            'id',
                            ['originalUnitPriceSet', [
                                ['shopMoney', [
                                    'amount',
                                    'currencyCode',
                                ]],
                            ]],
                            'quantity',
                            'requiresShipping',
                            'taxable',
                            'unfulfilledQuantity',
                        ]],
                    ]],
                ]],
            ]],
        ]],
    ]],
]);
