<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $mailingList->slug }}</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="font-sans">
            <!-- title -->
            <div class="bg-white max-w-xl mx-auto my-8">
                <h2 class="font-medium text-2lg mb-2 mx-auto">{{ $mailingList->name }}</h2>
            </div>

            <div class="max-w-xl mx-auto">
                <a class="text-black no-underline" href="/mailing-lists"> Back </a>
            </div>

            @foreach ($topics as $topic)
            <!-- Mail threads message -->
            <div class="bg-white max-w-xl mx-auto">
                <div class="flex pt-1 px-4">
                    <div class="px-2 pt-2 inline-flex">
                        <div class="flex-4">
                            <a href="{{ $topic->getTopicUrl() }}" class="text-black no-underline">
                                <span class="font-medium">{{ $topic->topic }}</span>
                            </a>
                        </div>

                        <div class="flex-1 pl-4">
                            <div class="text-xs text-grey flex items-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4 mr-1 feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span title="{{ $topic->created_at }}">{{ $topic->created_at->ago() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </body>
</html>
