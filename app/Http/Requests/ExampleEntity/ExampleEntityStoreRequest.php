<?php

declare(strict_types = 1);

namespace App\Http\Requests\ExampleEntity;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class ExampleEntityStoreRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'position' => [
                'sometimes',
                'int',
                'min:0',
            ],
        ];
    }
}
