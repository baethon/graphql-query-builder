<?php

use Baethon\Graphql\Builder\Builder as Gql;

// @TODO add support for nested arguments
return null;

return Gql::query(Gql::arguments(['$contractId' => 'ID!', '$date' => 'DateTime!']), [
    ['subscriptionBillingCycle', Gql::arguments(['billingCycleInput' => ['contractId' => '$contractId', 'selector' => ['date' => '$date']]]), [
        'billingAttemptExpectedDate',
    ]],
]);
