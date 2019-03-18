<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mailing Lists</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/custom.css" />
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    Mailing Lists for Bitcoin & Bitcoin Core
                </div>

                <div class="links">
                    @foreach ($mailingLists as $list)
                        <a href="/mailing-list/{{ $list->slug }}">{{ $list->name }}</a><br />
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
