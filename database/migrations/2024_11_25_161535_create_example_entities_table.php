<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('example_entities', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Уникальный идентификатор сущности');

            $table->uuid('created_by')->nullable()->index()->comment('Идентификатор пользователя, создавшего запись');
            $table->uuid('updated_by')->nullable()->index()->comment('Идентификатор пользователя, создавшего запись');
            $table->uuid('deleted_by')->nullable()->index()->comment('Идентификатор пользователя, создавшего запись');

            $table->string('name')->index()->comment('Имя сущности');
            $table->integer('position')->nullable()->comment('Позиция сущности');

            $table->timestamp('created_at')->index()->comment('Временная метка создания записи');
            $table->timestamp('updated_at')->nullable()->index()->comment('Временная метка изменения записи');
            $table->timestamp('deleted_at')->nullable()->index()->comment('Временная метка удаления записи');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('example_entities');
    }
};
