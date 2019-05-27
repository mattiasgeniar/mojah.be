<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bitcoin blockchain analysis: transactions per day</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div id="app" class="font-sans">
        <!-- title -->
        <div class="bg-white max-w-3xl mx-auto my-8">
            <h2 class="font-medium text-2lg ml-24 mb-2 mx-auto">Bitcoin blockchain analysis: transactions per day</h2>
            <a href="/analytics" class="no-underline text-grey">
                <span class="text-grey">&laquo; Back</span>
            </a>
        </div>

        <div class="bg-white max-w-3xl mx-auto my-8">
            Content goes here
        </div>
    </div>

    <script src="{{ mix('/js/topic-show.js') }}"></script>
</body>

</html>