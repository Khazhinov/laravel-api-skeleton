<?php

declare(strict_types=1);

namespace App\Http\Requests\ExampleEntity;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class ExampleEntityUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
        ];
    }
}
