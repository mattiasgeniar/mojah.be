<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Community resources for Bitcoin Core</title>

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app" class="font-sans">
            <!-- title -->
            <div class="bg-white max-w-xl mx-auto my-8">
                <h2 class="font-medium text-2lg mb-2 mx-auto">Community resources for Bitcoin Core</h2>
            </div>

            <base-card
                title="Mailing Lists"
                subtitle="Mailing list archives"
                href="/mailing-lists"
            ></base-card>
        </div>

        <script src="{{ mix('/js/welcome.js') }}"></script>
    </body>
</html>
