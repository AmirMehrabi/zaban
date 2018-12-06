<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ trans('activation.emails.send.title') }}</title>
    </head>

    <body style="direction: rtl;">
        <h1>{{ trans('activation.emails.send.heading', ['username' => $user->name]) }}</h1>

        <p>
            {!! trans('activation.emails.send.fst_paragraph', ['link' => $link]) !!}
        </p>

        <blockquote style="direction: ltr;">
            {{ $link }}
        </blockquote>

        <p>
            {{ trans('activation.emails.send.scnd_paragraph') }}
        </p>

        <p>
            {{ trans('activation.emails.send.last_paragraph') }}
        </p>
    </body>
</html>
