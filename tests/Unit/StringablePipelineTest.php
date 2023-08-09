<?php

use Baethon\Graphql\Builder\Contracts\Selectable;
use Baethon\Graphql\Builder\StringablePipeline;
use Baethon\Graphql\Builder\Traits\HasSelectors;

it('converts array to string', fn (array $input, string $expected) => expect((string) (new StringablePipeline($input)))->toEqual($expected)
)->with([
    'just fields' => [
        [
            'firstName',
            ['lastName'],
        ],
        "firstName\nlastName",
    ],
    'stringable objects' => [
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
    'stringable objects with modifiers' => [
        [
            [
                new class
                {
                    public int $i = 0;

                    public function __toString()
                    {
                        return "test: {$this->i}";
                    }

                    public function increment()
                    {
                        $this->i += 1;

                        return $this;
                    }
                },
                fn ($input) => $input->increment(),
                fn ($input) => $input->increment(),
            ],
        ],
        'test: 2',
    ],
    'nested fields' => [
        [
            [
                new class implements Selectable
                {
                    use HasSelectors;

                    public function __toString()
                    {
                        return 'test: '.json_encode($this->selectors);
                    }
                },
                [
                    'foo',
                    'bar',
                ],
            ],
        ],
        'test: ["foo","bar"]',
    ],
    'simple fields with stringable objects' => [
        [
            'first',
            ['second'],
            new class implements Stringable
            {
                public function __toString(): string
                {
                    return 'third';
                }
            },
            [new class implements Stringable
            {
                public function __toString(): string
                {
                    return 'fourth';
                }
            }],
        ],
        "first\nsecond\nthird\nfourth",
    ],
    'passes results of modifier' => [
        [
            [
                'first',
                fn () => 'test',
            ],
            'second',
        ],
        "test\nsecond",
    ],
]);
