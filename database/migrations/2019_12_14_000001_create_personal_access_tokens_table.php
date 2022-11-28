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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->comment('Уникальный идентификатор токена');

            $table->string('tokenable_type')->index()->comment('Название связываемой сущности');
            $table->uuid('tokenable_id')->index()->comment('Идентификатор связываемой сущности');
            $table->index(['tokenable_type', 'tokenable_id'], 'personal_access_tokens_tokenable_index');

            $table->string('name')->index()->comment('Название токена');
            $table->string('token', 64)->unique()->index()->comment('Токен');
            $table->text('abilities')->nullable()->comment('Разрешения токена');
            $table->timestamp('last_used_at')->nullable()->index()->comment('Временная метка последнего использования токена');
            $table->timestamp('expires_at')->nullable()->index()->comment('Временная метка окончания действия токена');
            $table->timestamp('created_at')->index()->comment('Временная метка создания записи');
            $table->timestamp('updated_at')->nullable()->index()->comment('Временная метка изменения записи');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
