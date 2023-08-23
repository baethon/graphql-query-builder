<?php

use Baethon\Graphql\Builder\Builder as Gql;

return Gql::mutation(Gql::args(['$definition' => 'MetaobjectDefinitionCreateInput!']), [
    ['metaobjectDefinitionCreate', Gql::args(['definition' => '$definition']), [
        ['metaobjectDefinition', [
            'name',
            'type',
            ['fieldDefinitions', [
                'name',
                'key',
            ]],
        ]],
        ['userErrors', [
            'field',
            'message',
            'code',
        ]],
    ]],
]);
