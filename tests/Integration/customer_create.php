<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::mutation(Gql::arguments(['$input' => 'CustomerInput!']), [
    ['customerCreate', Gql::arguments(['input' => '$input']), [
        ['userErrors', [
            'field',
            'message',
        ]],
        ['customer', [
            'id',
            'email',
            'phone',
            'taxExempt',
            'acceptsMarketing',
            'firstName',
            'lastName',
            'ordersCount',
            'totalSpent',
            ['smsMarketingConsent', [
                'marketingState',
                'marketingOptInLevel',
            ]],
            ['addresses', [
                'address1',
                'city',
                'country',
                'phone',
                'zip',
            ]],
        ]],
    ]],
]);
