<?php
namespace App\GraphQL\Types;

use App\Record;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;


class RecordType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Record',
        'description' => 'Collection of records and details of Artist',
        'model' => Record::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular record'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the record'
            ],
            'artist' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The artist of the record'
            ],
            'genre' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The genre of the record'
            ],
            'year_released' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The Year Released of the record'
            ],
            'record_label' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The record label of the record'
            ]
        ];
    }
}
