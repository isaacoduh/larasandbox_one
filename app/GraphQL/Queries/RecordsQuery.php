<?php

namespace App\graphql\Queries;

use App\Record;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class RecordsQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Record'));
    }

    public function resolve($root, $args)
    {
        return Record::all();
    }
}
