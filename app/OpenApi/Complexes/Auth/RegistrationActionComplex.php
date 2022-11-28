<?php

namespace App\OpenApi\Complexes\Auth;

use App\OpenApi\Complexes\Auth\RegistrationAction\RegistrationActionArgumentsDTO;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use JsonException;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactory;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactoryResult;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Reflector\ModelReflector;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Reflector\RequestReflector;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\ErrorResponse;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\SuccessSingleResourceResponse;
use ReflectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegistrationActionComplex extends ComplexFactory
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
        $arguments = new RegistrationActionArgumentsDTO($arguments);
        $model_reflector = new ModelReflector();
        $request_reflector = new RequestReflector();
        $complex_result = new ComplexFactoryResult();

        $complex_result->request_body = RequestBody::create()->content(
            MediaType::json()->schema(
                Schema::object('')->properties(
                    ...$request_reflector->getSchemaByRequest($arguments->validation_request)
                )
            ),
        );

        $complex_result->responses = [
            SuccessSingleResourceResponse::build(
                properties: $model_reflector->getSchemaForSingle($arguments->model_class, $arguments->single_resource),
            ),
            ErrorResponse::build(),
        ];

        return $complex_result;
    }
}
