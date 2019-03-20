<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $mailingList->slug }}: {{ $topic->topic }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/custom.css" />
    </head>
    <body>
        <div class="flex-center position-ref">
            <div>
                <div class="title m-b-md">
                    {{ $mailingList->name }}: {{ $topic->topic }}
                </div>

                <div class="links">
                    @foreach ($topic->messages as $message)
                        <img src="{{ $message->author->getGravatarAttribute() }}" />
                        From: {{ $message->author->display_name }}<br />
                        Date: {{ $message->created_at }}<br />

                        <pre>
{{ $message->content }}
                        </pre>

                        <hr class="post-seperator"/>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
