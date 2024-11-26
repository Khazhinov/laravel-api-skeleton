<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\Relationship;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\RelationshipTypeEnum;
use Khazhinov\LaravelLighty\Models\Model;
use Khazhinov\LaravelLighty\Models\UUID\Uuidable;
use Khazhinov\LaravelLighty\Models\UUID\UuidableContract;

/**
 * App\Models\ExampleEntity
 *
 * @property string $id Уникальный идентификатор сущности
 * @property string|null $created_by Идентификатор пользователя, создавшего запись
 * @property string|null $updated_by Идентификатор пользователя, создавшего запись
 * @property string|null $deleted_by Идентификатор пользователя, создавшего запись
 * @property string $name Имя сущности
 * @property int|null $position Позиция сущности
 * @property \Illuminate\Support\Carbon $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExampleReplation> $exampleRelations
 * @property-read int|null $example_relations_count
 * @method static \Database\Factories\ExampleEntityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExampleEntity withoutTrashed()
 * @mixin \Eloquent
 */
final class ExampleEntity extends Model implements UuidableContract
{
    use Uuidable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'position',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'position' => 'int',
    ];

    #[
        Relationship(
            related: ExampleReplation::class,
            type: RelationshipTypeEnum::HasMany,
            aliases: [
                'example_relations',
            ]
        )
    ]
    public function exampleRelations(): HasMany
    {
        return $this->hasMany(ExampleReplation::class);
    }
}
