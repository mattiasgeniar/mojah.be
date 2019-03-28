<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mailinglist author {{ $author->display_name }}</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body>
        <div id="app" class="font-sans">
            <!-- title -->
            <div class="bg-white max-w-xl mx-auto my-8 border border-grey-light">
                <div class="flex pt-4 px-4">
                    <div class="w-16 mr-2">
                        <img class="p-2 rounded rounded-full" src="{{ $author->gravatar }}">
                    </div>

                    <div class="px-2 pt-2 flex-grow w-full pb-4">
                        <h2 class="font-medium text-2lg mb-2 mx-auto">{{ $author->display_name }}</h2>
                        <span class="text-grey">Last message {{ $author->updated_at_ago }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white max-w-xl mx-auto mt-8">
                <author-topics-paginator
                    :author="{{ json_encode($author) }}"
                ></author-topics-paginator>
            </div>

            <div class="w-full h-8"></div>

            <div class="bg-white max-w-xl mx-auto mt-8">
                <author-messages-paginator
                    :author="{{ json_encode($author) }}"
                ></author-messages-paginator>
            </div>

        </div>

        <div class="w-full h-32"></div>

        <script src="{{ mix('/js/author-show.js') }}"></script>
    </body>
</html>
