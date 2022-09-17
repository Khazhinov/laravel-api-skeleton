<?php

namespace Database\Seeders;

use App\Models\ExampleEntity;
use Illuminate\Database\Seeder;

class ExampleEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ExampleEntity::factory()
            ->count(10)
            ->create();
    }
}
