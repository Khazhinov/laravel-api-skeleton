<?php

declare(strict_types = 1);

namespace App\OpenApi\Complexes\Auth\ProfileAction;

use Illuminate\Database\Eloquent\Model;
use Khazhinov\LaravelLighty\Http\Resources\SingleResource;
use Khazhinov\PhpSupport\DTO\DataTransferObject;
use Khazhinov\PhpSupport\DTO\Validation\ExistsInParents;

class ProfileActionArgumentsDTO extends DataTransferObject
{
    #[ExistsInParents(parent: Model::class)]
    public string $model_class;

    #[ExistsInParents(parent: SingleResource::class)]
    public string $single_resource;
}
