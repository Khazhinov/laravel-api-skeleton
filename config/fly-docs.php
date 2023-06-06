<?php

declare(strict_types = 1);

return [
    'default' => 'latest',
    'documentations' => [
        'latest' => [
            'info' => [
                'title' => 'Laravel API Skeleton',
                'description' => 'Автоматическая документация для демонстрации возможностей экосистемы',
                'version' => '1.0',
                'contact' => null,
                'license' => [
                    'name' => 'Пояснение для правил проверки Laravel',
                    'url' => 'https://laravel.com/docs/9.x/validation#available-validation-rules',
                ],
            ],

            'routes' => [
                /*
                 * Route for accessing api documentation interface
                */
                'docs_ui' => '/',
            ],
            'paths' => [
                'route_name_start_with' => [
                    'api.v1_0.',
                ],
            ],
        ],
    ],
    'default_documentation_body' => [
        'info' => [
            'title' => 'FlyDocs Swagger UI - Version: Latest',
            'description' => 'Some description for api',
            'version' => '1.0.0',
            'contact' => [
                'name' => 'Vladislav Khazhinov',
                'email' => 'khazhinov@gmail.com',
                'url' => 'https://github.com/khazhinov',
            ],
            'license' => [
                'name' => 'MIT',
                'url' => 'https://opensource.org/licenses/MIT',
            ],
            'extensions' => [
                // 'x-tagGroups' => [
                //     [
                //         'name' => 'General',
                //         'tags' => [
                //             'user',
                //         ],
                //     ],
                // ],
            ],
        ],

        'servers' => [
            [
                'url' => env('APP_URL', 'http://localhost:8000'),
                'description' => 'Development server',
                'variables' => [
//                    'VARIABLE' => [
//                        'default' => 'value',
//                        'enum' => ['value', 'not_value'],
//                        'description' => 'Variable description',
//                    ],
                ],
            ],
        ],

        'tags' => [
//             [
//                'name' => 'TagName',
//                'description' => 'Tag description',
//             ],
        ],

        'routes' => [
            /*
             * Route for accessing parsed swagger annotations.
            */
            'api_docs' => '/api-docs',

            /*
             * Route for Oauth2 authentication callback.
            */
            'oauth2_callback' => '/oauth2-callback',

            /*
             * Route Group options
            */
            'group_options' => [],
        ],

        'paths' => [
            /*
             * Absolute path to directory where to export views
            */
            'views_folder' => base_path('resources/views/vendor/fly-docs'),

            /*
             * Edit to set path where swagger ui assets should be stored
            */
            'swagger_ui_assets_path' => env('FLY_DOCS_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),
        ],

        /*
         * API security definitions. Will be generated into documentation file.
        */
        'security_definitions' => [
            'security_schemes' => [
                \App\OpenApi\SecuritySchemes\SecuritySchemeContainer::class,
            ],
        ],

        /*
         * Swagger UI configuration parameters
        */
        'ui' => [
            'display_doc_expansion' => env('FLY_DOCS_SWAGGER_UI_DOC_EXPANSION', 'none'),
            'display_filter' => env('FLY_DOCS_SWAGGER_UI_FILTERS', true),
            'persist_authorization' => env('FLY_DOCS_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
        ],

        'locations' => [
            'callbacks' => [
                app_path('OpenApi/Callbacks'),
            ],

            'request_bodies' => [
                app_path('OpenApi/RequestBodies'),
            ],

            'responses' => [
                app_path('OpenApi/Responses'),
            ],

            'schemas' => [
                app_path('OpenApi/Schemas'),
            ],

            'security_schemes' => [
                app_path('OpenApi/SecuritySchemes'),
            ],
        ],
    ],
];
