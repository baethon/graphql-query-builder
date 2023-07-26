<?php

use Baethon\Graphql\Builder\StringablePipeline;

it('converts array to string', fn (array $input, string $expected) => expect((string) (new StringablePipeline($input)))->toEqual($expected)
)->with([
    'just fields' => [
        [
            'firstName',
            ['lastName'],
        ],
        "firstName\nlastName",
    ],
    'complex objects' => [
        [
            new class
            {
                public function __toString()
                {
                    return 'test';
                }
            },
        ],
        'test',
    ],
    'complex objects with modifiels' => [
        [
            [
                new class
                {
                    public int $i = 0;

                    public function __toString()
                    {
                        return "test: {$this->i}";
                    }
                },
                fn ($input) => $input->i += 1,
                fn ($input) => $input->i += 1,
            ],
        ],
        'test: 2',
    ],
]);
