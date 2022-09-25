<?php

namespace App\Http\Resources\ExampleEntity;

use App\Models\ExampleEntity;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\CollectionResource;

/**
 * @property  ExampleEntity[] $collection
 */
class ExampleEntityCollection extends CollectionResource
{
    /**
     * @param $request
     * @return array <mixed>|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => $this->collection,
        ];
    }
}
