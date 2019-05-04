<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bitcoin blockchain analytics</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div id="app" class="font-sans">
        <!-- title -->
        <div class="bg-white max-w-xl mx-auto my-8">
            <h2 class="font-medium text-2lg mb-2 mx-auto">Bitcoin blockchain analytics</h2>
        </div>

        <div class="max-w-xl mx-auto">
            <a href="/" class="no-underline text-grey">
                <span class="text-grey">&laquo; Back</span>
            </a>
        </div>

        <div class="bg-white max-w-xl mx-auto mt-5">

        <div class="bg-white mx-auto max-w-lg shadow-lg rounded-lg overflow-hidden mb-5">
            <div class="h-16 px-2 flex items-center justify-between">
                <div class="ml-2">
                    <a href="/analytics/transactions-per-day" class="text-black no-underline">
                        <span class="font-medium">Graph: transaction count per day</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('/js/topic-index.js') }}"></script>
</body>

</html>