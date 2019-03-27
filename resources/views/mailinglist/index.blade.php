<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mailing Lists for Bitcoin Core</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

        <!-- RSS -->
        @include('feed::links')
    </head>

    <body>
        <div class="font-sans">
            <!-- title -->
            <div class="bg-white max-w-xl mx-auto my-8">
                <h2 class="font-medium text-2lg ml-24 mb-2 mx-auto">Mailing List archives for Bitcoin Core</h2>
            </div>

            @foreach ($mailingLists as $list)
            <div class="bg-white max-w-xl mx-auto">
                <div class="flex pt-1 px-4">
                    <div class="px-2 pt-2 inline-flex">
                        <div class="flex-4">
                            <a href="/mailing-list/{{ $list->slug }}" class="text-black no-underline">
                                - <span class="font-medium">{{ $list->name }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </body>
</html>

