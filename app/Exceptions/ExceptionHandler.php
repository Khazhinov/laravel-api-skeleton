<?php

namespace App\Exceptions;

use Illuminate\Foundation\Configuration\Exceptions as BaseExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
//use Sentry\Laravel\Integration;
use Khazhinov\LaravelLighty\Exceptions\JsonExceptionHandler;
use Throwable;

class ExceptionHandler extends JsonExceptionHandler
{
    public int $json_flags = JSON_UNESCAPED_SLASHES ^ JSON_UNESCAPED_UNICODE ^ JSON_THROW_ON_ERROR;

    public function __invoke(BaseExceptions $exceptions): BaseExceptions
    {
        $exceptions->renderable(
            fn (Throwable $exception, ?Request $request = null) => $this->jsonRender($request, $exception)
        );

        return $exceptions;
    }

    protected function reportSentry(BaseExceptions $exceptions): void
    {
        //        $exceptions->reportable(
        //            fn (Throwable $e) => Integration::captureUnhandledException($e)
        //        );
    }

    protected function registerErrorViewPaths(): void
    {
        View::replaceNamespace(
            'errors',
            collect(config('view.paths'))
                ->map(fn (string $path) => "$path/errors")
                ->push($this->vendorViews())
                ->all()
        );
    }

    protected function vendorViews(): string
    {
        return __DIR__ . '/../../vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/views';
    }
}
