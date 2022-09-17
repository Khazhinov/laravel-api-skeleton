<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ExampleEntity
 *
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExampleEntityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ExampleEntity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExampleEntity newQuery()
 * @method static \Illuminate\Database\Query\Builder|ExampleEntity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ExampleEntity query()
 * @method static \Illuminate\Database\Query\Builder|ExampleEntity withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ExampleEntity withoutTrashed()
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class ExampleEntity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property string $id Уникальный идентификатор пользователя
 * @property string|null $external_id Идентификатор пользователя во внешней системе
 * @property string|null $created_by Идентификатор пользователя, создавшего запись
 * @property string|null $updated_by Идентификатор пользователя, создавшего запись
 * @property string|null $deleted_by Идентификатор пользователя, создавшего запись
 * @property string $name Имя пользователя
 * @property string $email Email адрес пользователя
 * @property string $password Пароль пользователя
 * @property string|null $remember_token Токен долгоживущей сессии
 * @property \Illuminate\Support\Carbon|null $email_verified_at Временная метка подтверждения email адреса
 * @property \Illuminate\Support\Carbon|null $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
	class User extends \Eloquent {}
}

