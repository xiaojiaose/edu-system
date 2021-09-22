<?php

return [

    // 默认密码：secret
    UserSeeder::class => [
        [
            'email' => 'tom.student@jerry.com',
            'line_id' => 'U9f5e4d65e3a1bffeb4c4f8d158b87925',
            '@role' => 'student',
            '@following' => ['tom.teacher@jerry.com', 'tom.teacher.2@jerry.com'],
            '@school' => '清华大学',
        ],
        ['email' => 'tom.teacher@jerry.com', '@role' => 'teacher'],
        ['email' => 'tom.teacher.2@jerry.com', '@role' => 'teacher'],
        ['email' => 'tom.school@jerry.com', '@role' => 'teacher'],
        ['email' => 'tom.system_admin@jerry.com', '@role' => 'teacher'],
    ],

    SchoolSeeder::class => [
        ['name' => '清华大学', '@teachers' => ['tom.teacher@jerry.com']],
        ['name' => '北京大学', '@teachers' => ['tom.teacher@jerry.com', 'tom.teacher.2@jerry.com']],
        ['name' => '南京大学', '@teachers' => ['tom.teacher.2@jerry.com']],
        [
            'name' => '复旦大学',
            '@teachers' => ['tom.teacher.2@jerry.com'],
            '@managers' => ['tom.teacher.2@jerry.com'],
            '@creator' => 'tom.school@jerry.com',
        ],
    ],

    AdminMenuSeeder::class => [
        ['parent_id' => 0, 'order' => 20, 'icon' => 'fa-file', 'uri' => 'logs', 'title' => 'Log Viewer'],
        ['parent_id' => 0, 'order' => 100, 'icon' => 'fa-user', 'uri' => 'edu/students', 'title' => 'Edu Students'],
        ['parent_id' => 0, 'order' => 101, 'icon' => 'fa-user', 'uri' => 'edu/teachers', 'title' => 'Edu Teachers'],
        ['parent_id' => 0, 'order' => 102, 'icon' => 'fa-user', 'uri' => 'edu/users', 'title' => 'Edu Users'],
        ['parent_id' => 0, 'order' => 103, 'icon' => 'fa-list', 'uri' => 'edu/schools', 'title' => 'Edu Schools'],
    ],
];
