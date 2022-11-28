<?php

namespace App\OpenApi\Complexes\Auth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactory;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactoryResult;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\ErrorResponse;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\SuccessResponse;

class LogoutActionComplex extends ComplexFactory
{
    /**
     * @param  mixed  ...$arguments
     * @return ComplexFactoryResult
     */
    public function build(...$arguments): ComplexFactoryResult
    {
        $complex_result = new ComplexFactoryResult();

        $complex_result->responses = [
            SuccessResponse::build(
                data: Schema::string('ok')->example('ok'),
                data_type: 'array'
            ),
            ErrorResponse::build(),
        ];

        return $complex_result;
    }
}
