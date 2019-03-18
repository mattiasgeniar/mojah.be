<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $mailingList->slug }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/custom.css" />
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    {{ $mailingList->name }}
                </div>

                <div class="links">
                    @foreach ($mailingList->topics->sortBy('created_at') as $topic)
                        <a href="/mailing-list/{{ $mailingList->slug }}/{{ $topic->id }}">{{ $topic->topic }}</a> ({{ $topic->created_at }} by {{ $topic->author->display_name }})<br />
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
