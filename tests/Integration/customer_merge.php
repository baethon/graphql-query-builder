<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::mutation([
    ['customerMerge', Gql::args(['customerOneId' => 'gid://shopify/Customer/544365967', 'customerTwoId' => 'gid://shopify/Customer/624407574']), [
        'resultingCustomerId',
        ['job', [
            'id',
            'done',
        ]],
        ['userErrors', [
            'code',
            'field',
            'message',
        ]],
    ]],
]);
