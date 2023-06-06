<?php

namespace App\Http\Resources\ExampleEntity;

use App\Models\ExampleEntity;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\SingleResource;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @property  ExampleEntity $resource
 */
class ExampleEntityResource extends SingleResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<int|string, mixed>|Arrayable|JsonSerializable
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'position' => $this->resource->position,

            // Для сложных полей, вычисление которых занимает большое время
            //$this->mergeWhenByClosure($this->hasWith('properties.test'), static function ($context) {
            //    return [
            //        // 'test' => $context->test
            //    ];
            //}),

            // Для отношений, позволяет избегать проблемы N+1
            //$this->mergeWhenByClosure($this->hasWith('relationships.test'), static function ($context) {
            //    return [
            //        // 'test' => $context->test
            //    ];
            //}),

            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'deleted_at' => $this->resource->deleted_at,
        ];
    }
}
