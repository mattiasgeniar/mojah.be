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
                <author-threads></author-threads>
            </div>

            <div class="bg-white max-w-xl mx-auto mt-8">
                <h2>Threads started by this user</h2>
            </div>

            @foreach ($author->topics()->orderBy('created_at', 'desc')->get() as $topic)
            <!-- Mail threads message -->
            <div class="bg-white max-w-xl mx-auto">
                <div class="flex pt-1 px-4">
                    <div class="px-2 pt-2 inline-flex">
                        <div class="flex-4">
                            <a href="{{ $topic->topic_url }}" class="text-black no-underline">
                                <span class="font-medium">{{ $topic->topic }}</span>
                            </a>

                            <div class="text-xs text-grey flex items-center my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4 mr-1 feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span title="{{ $topic->created_at }}">{{ $topic->created_at_ago }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="bg-white max-w-xl mx-auto mt-8">
                <author-replies></author-replies>
            </div>

            <div class="bg-white max-w-xl mx-auto mt-8">
                <h2>Replies posted by this user</h2>
            </div>

            @foreach ($author->messages as $message)
            <!-- Mail threads message -->
            <div class="bg-white max-w-xl mx-auto">
                <div class="flex pt-1 px-4">
                    <div class="px-2 pt-2 inline-flex">
                        <div class="flex-4">
                            <a href="{{ $message->message_url }}" class="text-black no-underline">
                                <span class="font-medium">{{ $message->message_teaser }}</span>
                            </a>

                            <div class="text-xs text-grey flex items-center my-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4 mr-1 feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span title="{{ $message->created_at }}">{{ $message->created_at_ago }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <script src="{{ mix('/js/author-show.js') }}"></script>
    </body>
</html>
