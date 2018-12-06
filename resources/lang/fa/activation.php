<?php

return [
    "registration" => [
        "already_active"      => "اکانت شما فعال شده است!",
        "confirm_email"       => "تقریبا تمام است. فقط اکانت خود را فعال نمایید "
                               . "لینک فعال‌سازی اکانتتان برای شما ایمیل شده است. "
                               . "پس از ۲۴ ساعت منقضی می‌شود.",
        "email_sent"          => "متاسفیم، اکانت شما هنوز فعال نشده. "
                               . "کد فعال سازی به ایمیل ما ارسال شده (:when). "
                               . "پوشه اسپم خود را چک کنید.",
        "email_resent"        => "متاسفیم. کد فعال سازی شما منقضی شده است. "
                               . "ایمیل فعال سازی جدیدی به شما ارسال شده است. ",
        "invalid_credentials" => "مقادیر نامعتبر",
        "invalid_token"       => "Invalid Activation Code. Please Register to get a proper token.",
        "login_success"       => "شما وارد شده اید",
        "no_such_email"       => "همچین ایمیلی در پایگاه داده ما وجود ندارد."
    ],

    "emails" => [
        "admin_resend_subject"  => "یک کاربر کد فعال سازی جدیدی دریافت کرد.",
        "admin_send_subject"    => "یک کاربر جدید در سیستم ثبت نام کرد",
        "admin_welcome_subject" => "کاربر جدید با موفقیت فعال شد",
        "resend_subject"        => "کد فعال‌سازی جدید شما",
        "send_subject"          => "اکانت خود را فعال کنید.",
        "welcome_subject"       => "خوش آمدید!",

        "welcome" => [
            "title"   => "Welcome",
            "heading" => "ممنون از ثبت نام شما :username",
        ],
        "send" => [
            "title"          => "تائید ثبت نام",
            "heading"        => "ممنون به خاطر ثبت نام :username",
            "fst_paragraph"  => "شما می‌توانید از طریق <a href=':link'>این لینک</a> اکانت خود را فعال کنید. "
                              . "و یا لینک زیر را در مرورگر خود copy/paste نمایید. "
                              . "همین!",
            "scnd_paragraph" => "این لینک فعال‌سازی پس از  "
                              . config('user_activation.lifetime') . " ساعت منقضی می‌شود.",
            "last_paragraph" => "با آرزوی موفقیت.",
        ],
        "resend" => [
            "title"          => "کد فعال‌سازی جدید",
            "heading"        => "سلام :username"
                              . " شما درخواست لینک فعال سازی جدیدی را داده بودید.",
            "fst_paragraph"  =>  "شما می‌توانید از طریق <a href=':link'>این لینک</a> اکانت خود را فعال کنید. "
                              . "و یا لینک زیر را در مرورگر خود copy/paste نمایید. "
                              . "همین!",
            "scnd_paragraph" => "این لینک فعال‌سازی پس از  "
                              . config('user_activation.lifetime') . " ساعت منقضی می‌شود.",
            "last_paragraph" => "با آرزوی موفقیت.",
        ]
    ],
];
