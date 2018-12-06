<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="UTF-8">
        <title>{{ trans('activation.emails.welcome.title') }}</title>
    </head>

    <body style="direction: rtl;">
        <h1>{{ trans('activation.emails.welcome.heading', ['username' => $user->name]) }}!</h1>

        <p>
            اکانت شما فعال شده است. امیدواریم که آموزش‌های ما برای شما مفید واقع شود.
        </p>


        <p>
            با آرزوی موفقیت!
        </p>
    </body>
</html>
