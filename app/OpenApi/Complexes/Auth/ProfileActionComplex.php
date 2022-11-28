<?php

namespace App\OpenApi\Complexes\Auth;

use App\OpenApi\Complexes\Auth\ProfileAction\ProfileActionArgumentsDTO;
use JsonException;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactory;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactoryResult;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Reflector\ModelReflector;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\ErrorResponse;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\SuccessSingleResourceResponse;
use ReflectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ProfileActionComplex extends ComplexFactory
{
    /**
     * @param  mixed  ...$arguments
     * @return ComplexFactoryResult
     * @throws ReflectionException
     * @throws UnknownProperties
     * @throws JsonException
     */
    public function build(...$arguments): ComplexFactoryResult
    {
        $arguments = new ProfileActionArgumentsDTO($arguments);
        $model_reflector = new ModelReflector();
        $complex_result = new ComplexFactoryResult();

        $complex_result->responses = [
            SuccessSingleResourceResponse::build(
                properties: $model_reflector->getSchemaForSingle($arguments->model_class, $arguments->single_resource),
            ),
            ErrorResponse::build(),
        ];

        return $complex_result;
    }
}
