<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":attribute باید پذیرفته شده باشد.",
    "active_url" => "آدرس :attribute معتبر نیست",
    "after" => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha" => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array" => ":attribute باید شامل آرایه باشد.",
    "before" => ":attribute باید تاریخی قبل از :date باشد.",
    "between" => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array" => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    'string' => ':attribute باید شامل کارکتر باشد',
    "boolean" => "The :attribute field must be true or false",
    "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
    "date" => ":attribute یک تاریخ معتبر نیست.",
    "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
    "different" => ":attribute و :other باید متفاوت باشند.",
    "digits" => ":attribute باید :digits رقم باشد.",
    "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
    "email" => "فرمت :attribute معتبر نیست.",
    "exists" => ":attribute انتخاب شده، معتبر نیست.",
    "image" => ":attribute باید تصویر باشد.",
    "in" => ":attribute انتخاب شده، معتبر نیست.",
    "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip" => ":attribute باید IP آدرس معتبر باشد.",
    "max" => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
    "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
    "min" => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array" => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in" => ":attribute انتخاب شده، معتبر نیست.",
    "numeric" => ":attribute باید شامل عدد باشد.",
    "regex" => ":attribute یک فرمت معتبر نیست",
    "required" => "فیلد :attribute الزامی است",
    "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same" => ":attribute و :other باید مانند هم باشند.",
    "size" => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string" => ":attribute باید برابر با :size کاراکتر باشد.",
        "array" => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone" => "The :attribute must be a valid zone.",
    "unique" => ":attribute قبلا انتخاب شده است.",
    "url" => "فرمت آدرس :attribute اشتباه است.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),
    'attributes' => array(
        "name" => "نام",
        "family" => "فامیلی",
        "username" => "نام کاربری",
        "email" => "آدرس ایمیل",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "fname" => "نام",
        "lname" => "نام خانوادگی",
        "password" => "کلمه ی عبور",
        "password_now" => "کلمه ی عبور فعلی",
        "password_confirmation" => "تاییدیه ی کلمه ی عبور",
        "city" => "شهر",
        "state" => "استان",
        "country" => "کشور",
        "address" => "آدرس",
        "address_1" => "آدرس اول",
        "address_2" => "آدرس دوم",
        "phone" => "تلفن",
        "mobile" => "موبایل",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "توضیحات",
        "description" => "توضیحات",
        "descript" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "category" => "دسته بندی",
        "code" => "کد شرکت",
        "unit" => "واحد",
        "summary" => "خلاصه خبر",
        "photo" => "عکس خبر",
        "avatar" => "آواتار",
        "compony" => "شرکت",
        "job" => "سمت شغلی",
        "level" => "سطح حادثه",
        "file" => "فایل",
        "reportid" => "شماره گزارش",
        "cat_name" => "عنوان دسته بندی",
        "verify_type" => "نحوه ی رسیدگی",

        "group" => "نوع پیام",
        "price" => "قیمت",
        "explain" => "توضیحات پیام",
        "message" => "پیام",
        "domain" => "دامنه فعالیت",
        "domains" => "دامنه فعالیت",
        "domain_act" => "سایر دامنه فعالیت ها",
        "phone_1" => "شماره تماس خط_1",
        "phone_2" => "شماره تماس خط_2",
        "adress_office" => "آدرس دفتر",
        "num_nat" => "اسکن کارت ملی",
        "num_file" => "اسکن پرونده وکالت",
        "attachment[]" => "مدارک بارگذاری شده",
        "attachment" => "فایل بارگذاری شده",
        "id_yar" => "ای دی یار",
        "idYar" => "ای دی یار",
        "code_yar" => "کدیار",
        "codeYar" => "کدیار",
        "captcha" => "کپچا",
        "validation.captcha" => 'عبارت وارد شده مطابقت ندارد',
        "giftcard" => 'کارت هدیه',
        "home_adr" => 'آدرس منزل',
        "stady" => 'رشته تحصیلی',
        "other" => 'سایر موارد',
        "skill" => 'زمینه تخصص',
        "zip_code" => 'کدپستی',
    ),
);
