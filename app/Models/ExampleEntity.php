<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\Relationship;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\RelationshipTypeEnum;
use Khazhinov\LaravelLighty\Models\ModelLoggingable;

class ExampleEntity extends ModelLoggingable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
    ];

//    #[
//        Relationship(
//            related:AnotherModel::class,
//            type: RelationshipTypeEnum::BelongsTo,
//            aliases: [
//                'another_model'
//            ]
//        )
//    ]
//    public function anotherModel(): BelongsTo
//    {
//        return $this->belongsTo(AnotherModel::class);
//    }
}
