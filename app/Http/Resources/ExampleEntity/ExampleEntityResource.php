<?php

namespace App\Http\Resources\ExampleEntity;

use App\Models\ExampleEntity;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\SingleResource;

/** @property ExampleEntity $resource */
class ExampleEntityResource extends SingleResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<int|string, mixed>|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->resource->id,
            'position' => $this->resource->position,
            'name' => $this->resource->name,

            // Для сложных полей, вычисление которых занимает большое время
//            $this->mergeWhenByClosure($this->hasWith('properties.test'), static function ($context) {
//                return [
//                     'test' => $context->test
//                ];
//            }),

            // Для отношений, позволяет избегать проблемы N+1
//            $this->mergeWhenByClosure($this->hasWith('relationships.another_model'), static function ($context) {
//                return [
//                    'another_model' => new AnotherModel($context->anotherModel),
//                ];
//            }),


            $this->withLoggingableAttributes(),
        ];
    }
}
