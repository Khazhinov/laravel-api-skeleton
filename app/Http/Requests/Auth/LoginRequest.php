<?php

namespace App\Http\Requests\Auth;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }
}
