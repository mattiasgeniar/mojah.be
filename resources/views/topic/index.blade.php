<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $mailingList->name }} [{{ $mailingList->slug }}]</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div id="app" class="font-sans">
        <!-- title -->
        <div class="bg-white max-w-3xl mx-auto my-8">
            <h2 class="font-medium text-2lg mb-2 mx-auto">Mailing list topics: {{ $mailingList->name }}</h2>
        </div>

        <div class="max-w-3xl mx-auto">
            <a class="text-black no-underline" href="/mailing-lists"> Back </a>
        </div>

        <div class="bg-white max-w-3xl mx-auto mt-5">

            <topics-paginator mailing-list-slug="{{ $mailingList->slug }}" :initial-topic-paginator="{{ json_encode($topics) }}"></topics-paginator>

        </div>

        <div class="bg-white max-w-3xl mx-auto my-8 border border-grey-light rounded shadow-lg rounded-lg">
            <div class="pt-4 pb-4 px-4 text-grey text-center leading-normal">
                This is an archive from the official Bitcoin Core <a class="leading-normal text-grey underline hover:no-underline" href="https://lists.linuxfoundation.org/mailman/listinfo">mailing lists</a>. The code is <a class="leading-normal text-grey underline hover:no-underline" href="https://github.com/mattiasgeniar/CommunityBitcoin">entirely open source</a>.<br />
                BTC tipjar: <a class="leading-normal text-grey underline hover:no-underline" href="bitcoin:39ibqbqqBLrREGsLdAPdBobmSuKzT9mKhM">39ibqbqqBLrREGsLdAPdBobmSuKzT9mKhM<a>
            </div>
        </div>
    </div>

    <script src="{{ mix('/js/topic-index.js') }}"></script>
</body>

</html>