<?php


use App\Student;
use App\Subscribe;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $config = (require __DIR__ . '/config.php')[self::class];

        foreach ($config as $item) {
            if (User::whereEmail($item['email'])->first()) {
                $this->command->info($item['email'] . ' created before');
                continue;
            }
            User::forceCreate([
                'name' => explode('@', $item['email'])[0],
                'email' => $item['email'],
                'password' => bcrypt('123456'),
                "is_{$item['@role']}" => 1,
                'line_id' => $item['line_id'] ?? '',
            ]);
        }

        // 建立 follow 关系
        foreach ($config as $item) {
            if ($item['@following'] ?? []) {
                $student = Student::whereEmail($item['email'])->first();
                foreach ($item['@following'] as $teacherEmail) {
                    Subscribe::firstOrCreate([
                        'student_id' => $student->id,
                        'teacher_id' => Teacher::whereEmail($teacherEmail)->first()->id,
                    ]);
                }
            }
        }
    }
}
