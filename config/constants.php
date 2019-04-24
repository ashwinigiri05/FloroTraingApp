<?php
return [
    'TRACK_USER_FIELDS' => [
        'username',
        'email',
        'firstname',
        'lastname',
         'address',
        'house_number',
        'postal_code',
        'city',
        'contact_number',
    ],
    
    'QUEUES' => [
        'USER_CREATED_EMAIL_QUEUE' => env('USER_CREATED_EMAIL_QUEUE', 'user_created_email_queue')
    ],
    // 'TWO_FA_COMPANY_NAME' => 'super-Admin-By-Nish',
    // 'BACKUP_CODE_FILE_NAME' => 'backup_codes.txt',
    // 'BACKUP_FILE_CONTENT_TYPE' => 'text/plain',
    // 'HTTP_CODES' => [
    //     'SUCCESS' => 200,
    //     'CREATED' => 201,
    //     'VALIDATION_ERROR' => 422,
    //     'UNAUTHORIZED' => 401,
    //     'BAD_REQUEST' => 400,
    //     'FORBIDDEN' => 403,
    //     'INTERNAL_SERVER_ERROR' => 500,
    //     'METHOD_NOT_ALLOWED' => 405,
    //     'NOT_FOUND' => 404,
    // ],
    'USER_EXPORTED_FILE_PATH' => 'exports',
    'USER_EXPORTED_FILE_TYPE' => 'csv',
];