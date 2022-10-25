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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Уникальный идентификатор пользователя');
            $table->string('external_id')->nullable()->index()->comment('Идентификатор пользователя во внешней системе');

            $table->uuid('created_by')->nullable()->index()->comment('Идентификатор пользователя, создавшего запись');
            $table->uuid('updated_by')->nullable()->index()->comment('Идентификатор пользователя, создавшего запись');
            $table->uuid('deleted_by')->nullable()->index()->comment('Идентификатор пользователя, создавшего запись');

            $table->string('name')->index()->comment('Имя пользователя');
            $table->string('email')->unique()->index()->comment('Email адрес пользователя');
            $table->string('password')->index()->comment('Пароль пользователя');
            $table->string('remember_token', 100)->nullable()->index()->comment('Токен долгоживущей сессии');

            $table->timestamp('email_verified_at')->nullable()->index()->comment('Временная метка подтверждения email адреса');
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
        Schema::dropIfExists('users');
    }
};
