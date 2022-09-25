<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Command description';

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
        $project_name = helper_string_snake($dir);

        $needle_files = [
            'docker-compose.yaml.stub' => 'docker-compose.yaml',
            'docker-compose-dev.yaml.stub' => 'docker-compose-dev.yaml',
            '.env.local' => '.env',
        ];

        foreach ($needle_files as $needle_file => $result_file) {
            $content = @file_get_contents(base_path($needle_file));
            unlink(base_path($needle_file));
            $data = str_ireplace("laravel-api-skeleton", $project_name, $content);
            if (file_exists(base_path($result_file))) {
                unlink(base_path($result_file));
            }
            @file_put_contents(base_path($result_file), $data);
        }
        return 0;
    }
}