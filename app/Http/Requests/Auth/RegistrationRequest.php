<?php

namespace App\Http\Requests\Auth;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

class RegistrationRequest extends BaseRequest
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
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:5',
                'max:255',
            ],
        ];
    }
}
