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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->comment('Уникальный идентификатор задачи');

            $table->string('uuid')->unique()->comment('UUID задачи');
            $table->text('connection')->comment('Соедниение с очередью');
            $table->text('queue')->comment('Очередь выполнения');
            $table->longText('payload')->comment('Содержание задачи');
            $table->longText('exception')->comment('Исклюение, полученное в результате работы задачи');

            $table->timestamp('failed_at')->useCurrent()->index()->comment('Временная метка провала задачи');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
