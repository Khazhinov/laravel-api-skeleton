<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InitProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-api-skeleton:post-install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Подготовка каталога после первичной установки';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $base_path = base_path();
        $exploded_base_path = explode(DIRECTORY_SEPARATOR, $base_path);
        $dir = last($exploded_base_path);
        $project_name = Str::kebab($dir);

        File::deleteDirectory(base_path('art'));

        $needle_files = [
            'docker-compose.yaml.stub' => 'docker-compose.yaml',
            'docker-compose-containerized.yaml.stub' => 'docker-compose-containerized.yaml',
            '.env.localhost' => '.env',
        ];

        foreach ($needle_files as $needle_file => $result_file) {
            /** @var string $content */
            $content = @file_get_contents(base_path($needle_file));
            $data = str_ireplace("laravel-api-skeleton", $project_name, $content);
            if (file_exists(base_path($result_file))) {
                File::delete(base_path($result_file));
            }
            @file_put_contents(base_path($result_file), $data);
            File::delete(base_path($needle_file));
        }

        return 0;
    }
}
