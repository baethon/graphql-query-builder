<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\StringablePipeline;
use Baethon\Graphql\Builder\Traits\HasSelectors;

class NestedSelector implements Selectable
{
    use HasSelectors;

    public function __construct(array $selectors = null)
    {
        if (! is_null($selectors)) {
            $this->selectors = $selectors;
        }
    }

    public function __toString()
    {
        $chunks = [
            '{',
            (new StringablePipeline($this->selectors)),
            '}',
        ];

        return implode("\n", $chunks);
    }
}
