<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $mailingList->slug }}</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body>
        <div id="app" class="font-sans">
            <!-- title -->
            <div class="bg-white max-w-xl mx-auto my-8">
                <h2 class="font-medium text-2lg mb-2 mx-auto">{{ $mailingList->name }}</h2>
            </div>

            <div class="max-w-xl mx-auto">
                <a class="text-black no-underline" href="/mailing-lists"> Back </a>
            </div>

            <div class="bg-white max-w-xl mx-auto mt-5">

                <topics-paginator
                    mailing-list-slug="{{ $mailingList->slug }}"
                    :initial-topic-paginator="{{ json_encode($topics) }}"
                ></topics-paginator>

            </div>
        </div>

        <script src="{{ mix('/js/topic-index.js') }}"></script>
    </body>
</html>
