<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\Relationship;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\RelationshipTypeEnum;
use Khazhinov\LaravelLighty\Models\Model;
use Khazhinov\LaravelLighty\Models\UUID\Uuidable;
use Khazhinov\LaravelLighty\Models\UUID\UuidableContract;

/**
 * App\Models\ExampleEntity
 *
 * @property string|null $id Уникальный идентификатор
 * @property string $name Наименование
 * @property int|null $position Позиция сущности
 * @property \Illuminate\Support\Carbon|null $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
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

    //    #[
    //        Relationship(
    //            related: SomethingClass::class,
    //            type: RelationshipTypeEnum::BelongsTo,
    //            aliases: [
    //                'something_class',
    //            ]
    //        )
    //    ]
    //    public function somethingClass(): BelongsTo
    //    {
    //        return $this->belongsTo(SomethingClass::class);
    //    }
}
