<?php

return [

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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ' :attribute تم التسجيل به مسبقا.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    'custom' => [
        'first_name' => [
            'required' => 'الإسم الأول  مطلوب',
        ],
        'middle_name' => [
            'required' => 'الإسم الثاني  مطلوب',
        ],
        'last_name' => [
            'required' => 'اسم العائلة مطلوب',
        ],
        'address' => [
            'required' => 'العنوان مطلوب',
        ],
        'phone' => [
            'required' => ' يجب ادخال رقم الهاتف',
            'unique:users' => 'رقم الجوال تم التسجيل به مسبقاً', 
        
        ],
        'name' => [
            'required' => 'من فضلك ادخل  الإسم',
        ],
        'city' => [
            'required' => 'من فضلك ادخل  المحافظة',
        ],
        'name' => [
            'required' => 'الإسم مطلوب',
        ],
        'nationality' => [
            'required' => 'الجنسية مطلوب',
        ],
        'birth' => [
            'required' => 'تاريخ الميلاد مطلوب',
        ],
        'email' => [
            'required' => ' البريد الإلكتروني مطلوب',
            'email' => ' البريد الإلكتروني مطلوب',
            'same:email_confirm' => ' البريد الإلكتروني مطلوب',
            'unique:users,email' => 'عنوان البريد الإلكتروني تم التسجيل به سابقا'
        ],
        'password' => [
            'confirmed' => 'تأكيد كلمة المرور غير صحيح',
            'required' => 'كلمة المرور مطلوبة',
            'min'  => 'كلمة المرور يجب أن لا تقل عن 6 عناصر'
        ],
        'messege' => [
            'required' => 'يجب إدخال الرسالة',
        ],
        'subject' => [
            'required' => 'يجب إدخال العنوان',
        ],
        'title' => [
            'required' => 'يجب إدخال العنوان',
        ],
        'city' => [
            'required' => 'يجب إدخال المدينة',
        ],
        'country' => [
            'required' => 'يجب إدخال الدولة',
        ],
        'salary' => [
            'required' => 'يجب إدخال الراتب الشهري',
        ],
        'job_title' => [
            'required' => 'يجب إدخال عنوان الوظيفة',
        ],
        'company_name' => [
            'required' => 'يجب إدخال إسم الشركة',
        ],
        'language' => [
            'required' => 'يجب إدخال اللغة',
        ],
        'proficiency' => [
            'required' => 'يجب إدخال إجادة اللغة',
        ],
        'rating' => [
            'required' => 'يجب إدخال التقييم',
        ],
        'old-password' => [
            'required' => 'يجب إدخال كلمة المرور القديمة',
        ],
        'category_id' => [
            'required' => 'يجب إدخال مجال الوظيفة',
        ],
        'average_salary' => [
            'required' => 'يجب إدخال الراتب الشهري',
        ],
        'experience' => [
            'required' => 'يجب إدخال الخبرة',
        ],
        'gender' => [
            'required' => 'يجب إدخال الجنس',
        ],
        'married' => [
            'required' => 'يجب إدخال الحالة الإجتماعية',
        ],
        'countryCode' => [
            'required' => 'يجب إدخال ترميز الدولة',
        ],
        'religion' => [
            'required' => 'يجب إدخال الديانة',
        ],
        'nationality' => [
            'required' => 'يجب إدخال الجنسية',
        ],
        'job_title' => [
            'required' => 'يجب إدخال عنوان الوظيفة',
        ],
        'school' => [
            'required' => 'يجب إدخال المدرسة/المعهد/الكلية',
        ],
        'degree' => [
            'required' => 'يجب إدخال شهادة التعليم',
        ],
        'level' => [
            'required' => 'يجب إدخال مستوى التعليم',
        ],
        'phone_number' => [
            'required' => 'يجب إدخال رقم الهاتف',
            'min:11' => 'يجب أن لا يقل الرقم عن 11 رقم',
            'numeric' => 'يجب أن تكون المدخلات أرقام',
       ],
        'verfication_code' => [
            'required' => 'يجب إدخال كود التحقق',
        ],
        'profile_image' => [
            'image' => 'يجب أن يكون الملف صورة',
            'max:1999' => 'يجب أن لا يزد حجم الصورة عن 2 ميجابايت',
        ],
        'cv' => [
            'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip' => 'يجب أن يكون الملف بإحدى هذه الصيغ: jpeg,png,jpg,gif,svg,doc,pdf,docx,zip',
            'max:9999' => 'يجب أن لا يزيد حجم الملف عن 10 ميجابايت',
        ],
        'brief' => [
            'required' => 'يجب إدخال نبذة عن التعليم',
            'string' => 'يجب أن تكون المدخلات أحرف ',
            'min:10' => 'يجب أن لا تقل النبذة عن 10 أحرف',
            'max:90' => 'يجب ألا تزيد النبذة عن 90 حرف',
        ],
        'gallery_image' => [
            'image' => 'يجب أن يكون الملف صورة',
            'max:1999' => 'يجب أن لا يزيد حجم الصورة عن 2 ميجابايت',
        ],
        'g-captcha-response' => [
            'required' => 'تحقق أنك لست روبوت',
        ],
        'phone_no' => [
            'required' => 'رقم الجوال مطلوب',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'phone' => 'رقم الجوال'
        ],

];
