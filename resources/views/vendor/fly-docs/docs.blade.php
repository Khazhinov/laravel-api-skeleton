@php
    $config = \Khazhinov\LaravelFlyDocs\Services\ConfigFactory::getInstance();
    $documentation_config = $config->documentationConfig($documentation);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $documentation_config->info->title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ fly_docs_swagger_asset($documentation, 'swagger-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ fly_docs_swagger_asset($documentation, 'favicon-32x32.png') }}"
          sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ fly_docs_swagger_asset($documentation, 'favicon-16x16.png') }}"
          sizes="16x16"/>
    <style>
        html {
            box-sizing: border-box;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>

<script src="{{ fly_docs_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
<script src="{{ fly_docs_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
<script>
    window.onload = function () {
        // Build a system
        const ui = SwaggerUIBundle({
            dom_id: '#swagger-ui',
            url: "{!! $api_documentation_url !!}",
            @if($documentation_config->routes->oauth2_callback !== '')
            oauth2RedirectUrl: "{{ route('fly-docs.'.$documentation.'.oauth2_callback') }}",
            @endif
            requestInterceptor: function (request) {
                request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                return request;
            },
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "BaseLayout",
            docExpansion: "none",
            deepLinking: true,
            filter: true,
            persistAuthorization: false,
        })
        window.ui = ui
    }
</script>
</body>
</html>
