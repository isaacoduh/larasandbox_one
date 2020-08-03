<?php
namespace App\GraphQL\Queries;


use App\Record;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class RecordQuery extends Query
{
    protected $attributes = [
        'name' => 'record'
    ];

    public function type(): Type
    {
        return GraphQL::type('Record');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Record::findOrfail($args['id']);
    }
}
