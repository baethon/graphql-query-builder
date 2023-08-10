<?php

namespace Baethon\Graphql\Builder;

class StringablePipeline
{
    public function __construct(
        private array $chunks,
        private Pipeline $pipeline = new Pipeline,
    ) {
    }

    public function __toString()
    {
        $lines = array_map(
            $this->pipeline->reduceLine(...),
            $this->chunks,
        );

        return trim(implode("\n", $lines));
    }
}
