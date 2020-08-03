<?php

namespace App\GraphQL\Mutations;

use App\Record;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;


class UpdateRecordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateRecord'
    ];

    public function type(): Type
    {
        return GraphQL::type('Record');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
            'title' => ['name' => 'title', 'type' => Type::nonNull(Type::string()),],
            'artist' => ['name' => 'artist', 'type' => Type::nonNull(Type::string())],
            'genre' => ['name' => 'genre', 'type' => Type::nonNull(Type::string())],
            'year_released' => ['name' => 'year_released', 'type' => Type::nonNull(Type::string())],
            'record_label' => ['name' => 'record_label', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args)
    {
        $record = Record::findOrfail($args['id']);
        $record->fill($args);
        $record->save();

        return $record;
    }
}
