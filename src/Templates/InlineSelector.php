<?php

namespace Baethon\Graphql\Builder\Templates;

use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\StringablePipeline;
use Baethon\Graphql\Builder\Traits\HasSelectors;

class InlineSelector implements Selectable
{
    use HasSelectors;

    public function __construct(
        private string $type,
    ) {
    }

    public function __toString()
    {
        if ($this->selectors === []) {
            throw new \RuntimeException('The InlineSelector requires selectors');
        }

        $chunks = [
            "... on {$this->type} {",
            (new StringablePipeline($this->selectors)),
            '}',
        ];

        return implode("\n", $chunks);
    }
}
