<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('example_entities', function (Blueprint $table) {
            $table->foreign('created_by', 'example_entities_created_by_foreign')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION')
            ;

            $table->foreign('updated_by', 'example_entities_updated_by_foreign')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION')
            ;

            $table->foreign('deleted_by', 'example_entities_deleted_by_foreign')
                ->references('id')
                ->on('users')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('example_entities', function (Blueprint $table) {
            $table->dropForeign('example_entities_deleted_by_foreign');
            $table->dropForeign('example_entities_updated_by_foreign');
            $table->dropForeign('example_entities_created_by_foreign');
        });
    }
};
