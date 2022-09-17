<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1_0\ExampleEntity;

use App\Http\Requests\ExampleEntity\ExampleEntityStoreRequest;
use App\Http\Requests\ExampleEntity\ExampleEntityUpdateRequest;
use App\Http\Resources\ExampleEntity\ExampleEntityCollection;
use App\Http\Resources\ExampleEntity\ExampleEntityResource;
use App\Models\ExampleEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as DatabaseBuilder;
use JsonException;
use Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\ApiCRUDController;
use Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\DTO\ActionClosureModeEnum;
use Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\DTO\ApiCRUDControllerMetaDTO;
use Khazhinov\LaravelLighty\Http\Requests\CRUD\BulkDestroyRequest;
use Khazhinov\LaravelLighty\Http\Requests\CRUD\IndexRequest;
use Khazhinov\LaravelLighty\Http\Requests\CRUD\SetPositionRequest;
use Khazhinov\LaravelLighty\Transaction\WithDBTransaction;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ExampleEntityCRUDController extends ApiCRUDController
{
    use WithDBTransaction;

    /**
     * @throws UnknownProperties
     * @throws ReflectionException
     */
    public function __construct()
    {
        parent::__construct(new ApiCRUDControllerMetaDTO([
            'model_class' => ExampleEntity::class,
            'single_resource_class' => ExampleEntityResource::class,
            'collection_resource_class' => ExampleEntityCollection::class,
        ]));
    }

    /**
     * @param  IndexRequest  $request
     * @return BinaryFileResponse|Response
     * @throws ReflectionException
     * @throws UnknownProperties
     * @throws JsonException
     */
    public function index(IndexRequest $request): mixed
    {
        return $this->indexAction(
            request: $request,
            options: []
        );
    }

    /**
     * @param  SetPositionRequest  $request
     * @return Response
     * @throws UnknownProperties
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Throwable
     */
    public function setPosition(SetPositionRequest $request): Response
    {
        return $this->setPositionAction(
            request: $request,
            options: []
        );
    }

    /**
     * @param  BulkDestroyRequest  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    public function bulkDestroy(BulkDestroyRequest $request): Response
    {
        return $this->bulkDestroyAction(
            request: $request,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::AfterDeleting) {
                    // do something...
                }
            }
        );
    }

    /**
     * @param  string $key
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws UnknownProperties
     */
    public function show(string $key): Response
    {
        return $this->showAction(
            key: $key,
            options: []
        );
    }

    /**
     * @param  ExampleEntityStoreRequest  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    public function store(ExampleEntityStoreRequest $request): Response
    {
        return $this->storeAction(
            request: $request,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::BeforeFilling) {
                    // do something...
                }
            }
        );
    }

    /**
     * @param  ExampleEntityUpdateRequest  $request
     * @param  string $key
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    public function update(ExampleEntityUpdateRequest $request, string $key): Response
    {
        return $this->updateAction(
            request: $request,
            key: $key,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::AfterSave) {
                    // do something...
                }
            }
        );
    }

    /**
     * @param  string  $key
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    public function destroy(string $key): Response
    {
        return $this->destroyAction(
            key: $key,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::BeforeDeleting) {
                    // do something...
                }
            }
        );
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultOrder(): array
    {
        return [
            '-id',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getQueryBuilder(): Builder|DatabaseBuilder
    {
        return ExampleEntity::query();
    }
}
