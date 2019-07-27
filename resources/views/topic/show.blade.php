<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $mailingList->slug }}: {{ $topic->topic }}</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

    <!-- JavaScript -->
    <script>
        function toggleDiv(id) {
            var x = document.getElementById(id);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <div id="app" class="font-sans">
        <!-- title -->
        <div class="bg-white max-w-3xl mx-auto my-8">
            <h2 class="font-medium text-2lg ml-24 mb-2 mx-auto">{{ $mailingList->name }}: {{ $topic->topic }}</h2>
            <a href="{{ $mailingList->getListUrl() }}" class="no-underline text-grey">
                <span class="text-grey">&laquo; Back</span>
            </a>
        </div>

        <div class="bg-white max-w-3xl mx-auto my-8">
            <topic-show :topic="{{ json_encode($topic) }}"></topic-show>
        </div>


        <div class="bg-white max-w-3xl mx-auto my-8 border border-grey-light rounded shadow-lg rounded-lg">
            <div class="pt-4 pb-4 px-4 text-grey text-center leading-normal">
                This is an archive from the official Bitcoin Core <a class="leading-normal text-grey hover:no-underline" href="https://lists.linuxfoundation.org/mailman/listinfo">mailing lists</a>. The code is <a class="leading-normal text-grey underline hover:no-underline" href="https://github.com/mattiasgeniar/CommunityBitcoin">entirely open source</a>.<br />
                BTC tipjar: <a class="leading-normal text-grey underline hover:no-underline" href="bitcoin:39xyx1A85hoM7fKyhPCmyLT891KxDXwVX9">39xyx1A85hoM7fKyhPCmyLT891KxDXwVX9<a>
            </div>
        </div>

        <div class="w-full h-16"></div>
    </div>

    <script src="{{ mix('/js/topic-show.js') }}"></script>
</body>

</html>