<?php

declare(strict_types=1);

namespace App\Http\Requests\ExampleEntity;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class ExampleEntityUpdateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}


