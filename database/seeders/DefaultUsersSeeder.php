<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Khazhinov\LaravelLighty\Services\SystemUserPayloadService;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        /** @var User $user */
        $user = User::create(SystemUserPayloadService::getSystemUserPayload());
//        $user->markEmailAsVerified();
        $user->save();
    }
}
