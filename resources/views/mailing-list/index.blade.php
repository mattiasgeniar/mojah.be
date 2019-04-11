<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mailing Lists for Bitcoin Core</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

    <!-- RSS -->
    @include('feed::links')
</head>

<body>
    <div id="app" class="font-sans">
        <!-- title -->
        <div class="bg-white max-w-xl mx-auto my-8">
            <h2 class="font-medium text-2lg mb-2 mx-auto">Mailing List archives for Bitcoin Core</h2>
        </div>

        <div class="max-w-xl mx-auto">
            <a class="text-black no-underline" href="/">&laquo; Back </a> | <a class="text-black no-underline" href="/mailing-list/rss"> RSS feed </a>
        </div>

        @foreach ($mailingLists as $list)
        <base-card class="mb-4" title="{{ $list->name }}" subtitle="" href="/mailing-lists/{{ $list->slug }}"></base-card>
        @endforeach
    </div>

    <script src="{{ mix('/js/mailing-list-index.js') }}"></script>
</body>

</html>