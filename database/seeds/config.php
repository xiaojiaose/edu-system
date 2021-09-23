<?php

return [

    // 默认密码：secret
    UserSeeder::class => [
        [
            'email' => 'student@163.com',
            'line_id' => 'U9f5e4d65e3a1bffeb4c4f8d158b87925',
            '@role' => 'student',
            '@following' => ['wang-teacher@163.com', 'zhang-teacher@163.com'],
            '@school' => '清华大学',
        ],
        ['email' => 'wang-teacher@163.com', '@role' => 'teacher'],
        ['email' => 'zhang-teacher@163.com', '@role' => 'teacher'],
        ['email' => 'wang-school@163.com', '@role' => 'teacher'],
    ],

    SchoolSeeder::class => [
        ['name' => '清华大学', '@teachers' => ['wang-teacher@163.com'], '@managers' => ['wang-school@163.com'], '@creator' => 'wang-school@163.com'],
        ['name' => '北京大学', '@teachers' => ['wang-teacher@163.com', 'zhang-teacher@163.com'], '@managers' => ['wang-school@163.com'], '@creator' => 'wang-school@163.com'],
        ['name' => '南京大学', '@teachers' => ['zhang-teacher@163.com']],
        [
            'name' => '复旦大学',
            '@teachers' => ['zhang-teacher@163.com','wang-school@163.com'],
            '@managers' => ['wang-school@163.com'],
            '@creator' => 'wang-school@163.com',
        ],
    ],

    AdminMenuSeeder::class => [
        ['parent_id' => 0, 'order' => 100, 'icon' => 'fa-user', 'uri' => 'edu/students', 'title' => 'Edu Students'],
        ['parent_id' => 0, 'order' => 101, 'icon' => 'fa-user', 'uri' => 'edu/teachers', 'title' => 'Edu Teachers'],
        ['parent_id' => 0, 'order' => 102, 'icon' => 'fa-user', 'uri' => 'edu/users', 'title' => 'Edu Users'],
        ['parent_id' => 0, 'order' => 103, 'icon' => 'fa-list', 'uri' => 'edu/schools', 'title' => 'Edu Schools'],
    ],
];
