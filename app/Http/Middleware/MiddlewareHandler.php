<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Configuration\Middleware as BaseMiddleware;

class MiddlewareHandler
{
    /** @var string[] */
    protected array $middleware_global_to_remove = [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Session\Middleware\StartSession::class,
    ];

    /** @var string[] */
    protected array $middleware_global = [
        // \Illuminate\Http\Middleware\TrustHosts::class,
    ];

    /** @var array<string, array<string>> */
    protected array $middleware_groups = [
        'web' => [],
        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
//            \App\Http\Middleware\SentryContext::class,
        ],
    ];

    protected array $aliases = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    ];

    public function __invoke(BaseMiddleware $middleware): BaseMiddleware
    {
        // Обнуляем глобальные Middleware
        $middleware->use([]);

        // Резервно удаляем Middleware из групп
        $middleware->web(remove: $this->middleware_global_to_remove);
        $middleware->api(remove: $this->middleware_global_to_remove);
        foreach ($this->middleware_global_to_remove as $middleware_global_to_remove) {
            $middleware->remove($middleware_global_to_remove);
        }

        // Принудительно вырубаем Cookie и CSRF
        $middleware->validateCsrfTokens(except: ['*']);
        $middleware->encryptCookies(except: ['*']);

        // Регистрируем глобальные Middleware
        if ($this->middleware_global) {
            foreach ($this->middleware_global as $middleware_global) {
                $middleware->append($middleware_global);
            }
        }

        // Регистрируем групповые Middleware
        if ($this->middleware_groups) {
            foreach ($this->middleware_groups as $group => $middleware_group) {
                foreach ($middleware_group as $middleware_class) {
                    $middleware->$group(append: $middleware_class);
                }
            }
        }

        // Регистрируем Middleware Aliases
        if ($this->aliases) {
            $middleware->alias($this->aliases);
        }

        // Выставляем приоритет Middleware
        $result_priority = helper_array_merge_recursive_distinct(
            $this->middleware_global,
            $this->middleware_groups['web'],
            $this->middleware_groups['api'],
        );
        $middleware->priority($result_priority);

        return $middleware;
    }
}
