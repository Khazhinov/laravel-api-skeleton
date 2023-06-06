<?php

declare(strict_types = 1);

namespace App\OpenApi\SecuritySchemes;

use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement;
use Khazhinov\LaravelFlyDocs\Generator\Builders\Components\SecuritySchemesContainerContract;

class SecuritySchemeContainer implements SecuritySchemesContainerContract
{
    /**
     * @return array<mixed>
     * @throws \GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException
     */
    public static function getSecuritySchemes(): array
    {
        return [
            SecurityRequirement::create()->securityScheme('ApiAuthSecurityScheme'),
        ];
    }
}
