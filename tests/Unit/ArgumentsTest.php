<?php

use Baethon\Graphql\Builder\Arguments;
use Baethon\Graphql\Builder\RawValue;

it('converts arguments list to string', function ($input, string $expected) {
    $arguments = new Arguments($input);

    expect((string) $arguments)->toEqual($expected);
})->with([
    [
        ['$ids' => '[ID!]!'],
        '$ids: [ID!]!',
    ],
    [
        ['ids' => '[ID!]!'],
        'ids: [ID!]!',
    ],
    [
        ['id' => 'gid://Product/1'],
        'id: "gid://Product/1"',
    ],
    [
        ['id' => 1],
        'id: 1',
    ],
    [
        ['key' => 'ARRAY_FIRST'],
        'key: ARRAY_FIRST',
    ],
    [
        ['$key' => 'ARRAY_FIRST'],
        '$key: ARRAY_FIRST',
    ],
    [
        ['id' => '$id'],
        'id: $id',
    ],
    [
        ['key' => '_ARRAY'],
        'key: "_ARRAY"',
    ],
    [
        ['sync' => true],
        'sync: true',
    ],
    [
        ['sync' => false],
        'sync: false',
    ],
    [
        ['$id' => 'ID'],
        '$id: ID',
    ],
    [
        ['$id' => 'ID!'],
        '$id: ID!',
    ],
    [
        ['$id' => 'String!'],
        '$id: String!',
    ],
    [
        ['id' => 'String!'],
        'id: "String!"',
    ],
    [
        ['$id' => 'String'],
        '$id: String',
    ],
    [
        ['$type' => 'SpecialCharacter'],
        '$type: SpecialCharacter',
    ],
    [
        ['step' => 1.5],
        'step: 1.5',
    ],
    [
        ['$ids' => '[ID!]!', '$context' => 'InputContext!'],
        '$ids: [ID!]!, $context: InputContext!',
    ],
    [
        ['step' => RawValue::quote(1.5)],
        'step: "1.5"',
    ],
]);

it('wraps arguments', function () {
    $expected = new Arguments(['$id' => 'ID!']);

    expect(Arguments::wrap(['$id' => 'ID!']))->toEqual($expected);
    expect(Arguments::wrap($expected))->toEqual($expected);
});
