<?php

namespace App\GraphQL\Mutations;

use App\Record;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;


class DeleteRecordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteRecord',
        'description' => 'Delete a Record'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['requird']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $record = Record::findOrfail($args['id']);
        return $record->delete() ? true : false;
    }
}
