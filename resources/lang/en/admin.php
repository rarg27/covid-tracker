<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'terminal' => [
        'title' => 'Terminals',

        'actions' => [
            'index' => 'Terminals',
            'create' => 'New Terminal',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'location' => 'Location',
            
        ],
    ],

    'conductor' => [
        'title' => 'Conductors',

        'actions' => [
            'index' => 'Conductors',
            'create' => 'New Conductor',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'terminal_id' => 'Terminal',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            
        ],
    ],

    'transportation-log' => [
        'title' => 'Transportation Logs',

        'actions' => [
            'index' => 'Transportation Logs',
            'create' => 'New Transportation Log',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'resident_id' => 'Resident',
            'terminal_id' => 'Terminal',
            'conductor_id' => 'Conductor',
            'driver_id' => 'Driver'
        ],
    ],

    'resident' => [
        'title' => 'Residents',

        'actions' => [
            'index' => 'Residents',
            'create' => 'New Resident',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'birth_date' => 'Birth date',
            'contact_number' => 'Contact number',
            
        ],
    ],

    'driver' => [
        'title' => 'Drivers',

        'actions' => [
            'index' => 'Drivers',
            'create' => 'New Driver',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'terminal_id' => 'Terminal'
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];