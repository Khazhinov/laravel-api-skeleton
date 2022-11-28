<?php

namespace App\Http\Controllers\Api\V1_0\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\OpenApi\Complexes\Auth\LoginActionComplex;
use App\OpenApi\Complexes\Auth\LogoutActionComplex;
use App\OpenApi\Complexes\Auth\ProfileActionComplex;
use App\OpenApi\Complexes\Auth\RegistrationActionComplex;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JsonException;
use Khazhinov\LaravelFlyDocs\Generator\Attributes as OpenApi;
use Khazhinov\LaravelLighty\Exceptions\Auth\AuthException;
use Khazhinov\LaravelLighty\Http\Controllers\Api\ApiController;
use Khazhinov\LaravelLighty\Transaction\WithDBTransaction;
use Khazhinov\LaravelLighty\Transaction\WithDBTransactionInterface;
use ReflectionException;
use RuntimeException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

#[OpenApi\PathItem]
class AuthController extends ApiController implements WithDBTransactionInterface
{
    use WithDBTransaction;

    /**
     * Пробный маршрут для регистрации пользователей
     *
     * @throws UnknownProperties
     * @throws Throwable
     * @throws ReflectionException
     * @throws JsonException
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\Complex(
        factory: RegistrationActionComplex::class,
        model_class: User::class,
        single_resource: UserResource::class,
        validation_request: RegistrationRequest::class,
    )]
    public function registration(RegistrationRequest $request): ?Response
    {
        $user = new User();

        foreach ($user->getFillable() as $filed) {
            if ($request->has($filed)) {
                $user->setAttribute($filed, $request->get($filed));
            }
        }

//        $user->markEmailAsVerified();

        $this->beginTransaction();

        try {
            $user->save();

            event(new Registered($user));

            $this->commit();

            return $this->respond(
                $this->buildActionResponseDTO(
                    data: new UserResource($user),
                )
            );
        } catch (Throwable $exception) {
            $this->rollback();

            throw $exception;
        }
    }

    /**
     * Метод для получения токена
     *
     * @param  LoginRequest  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\Complex(
        factory: LoginActionComplex::class,
        model_class: User::class,
        single_resource: UserResource::class,
        validation_request: LoginRequest::class,
    )]
    public function login(LoginRequest $request): Response
    {
        /** @var ?User $user */
        $user = User::where('email', $request->get('email'))->first();

        if (! $user) {
            throw new AuthException('Ошибка! Некорректные данные в запросе.');
        }

        if (Hash::check($request->get('password'), $user->password)) {
            $token = $user->createToken('base');
            $user->save();

            return $this->respond(
                $this->buildActionResponseDTO(
                    data: [
                        'token' => $token->plainTextToken,
                        'profile' => new UserResource($user, true),
                    ]
                )
            );
        }

        throw new AuthException('Ошибка! Некорректные данные в запросе.');
    }

    /**
     * Метод для удаления токена
     *
     * @param  Request  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\Complex(
        factory: LogoutActionComplex::class,
    )]
    public function logout(Request $request): Response
    {
        /** @var ?User $user */
        $user = $request->user();
        if ($user) {
            /** @var Model $current_token */
            $current_token = $user->currentAccessToken();

            if ($current_token->delete()) {
                return $this->respond(
                    $this->buildActionResponseDTO(
                        data: ['ok']
                    )
                );
            }
        }

        throw new RuntimeException('Ошибка! Некорректные данные в запросе.');
    }

    /**
     * Метод для получения профиля пользователя
     *
     * @param  Request  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\Complex(
        factory: ProfileActionComplex::class,
        model_class: User::class,
        single_resource: UserResource::class,
    )]
    public function profile(Request $request): Response
    {
        return $this->respond(
            $this->buildActionResponseDTO(
                data: new UserResource($request->user(), true),
            )
        );
    }
}
