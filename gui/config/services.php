<?php

return [
    'profile' => [
        'urls' => [
            'auth' => 'http://localhost:1020/auth/authenticate?produces=json',
        ],
    ],
    'core' => [
        'urls' => [
            'readuserbyid' => 'http://localhost:1010/users/readbyid/',
            'readuserbyemail' => 'http://localhost:1010/users/readbyemail/',
            'companyinfo' => 'http://localhost:1010//companies/readbyid/',
        ],
    ],
];
