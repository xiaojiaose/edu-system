<?php


use App\School;
use App\SchoolTeacher;
use App\Student;
use App\Teacher;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run()
    {
        $configs = require __DIR__ . '/config.php';

        foreach ($configs[self::class] as $item) {
            if ($school = School::whereName($item['name'])->first()) {
                continue;
            }

            $creatorId = isset($item['@creator']) ? Teacher::whereEmail($item['@creator'])->first()->id : 0;
            $school = School::forceCreate([
                'name' => $item['name'],
                'creator_id' => $creatorId,
                'approve_time' => $item['approve_time'] ?? null,
            ]);

            $teacherIds = Teacher::whereIn('email', $item['@teachers'] ?? [])->pluck('id')->all();
            $mangerIds = Teacher::whereIn('email', $item['@managers'] ?? [])->pluck('id')->all();
            foreach ($teacherIds as $teacherId) {
                SchoolTeacher::firstOrCreate(
                    [
                        'school_id' => $school->id,
                        'teacher_id' => $teacherId,
                    ],
                    [
                        'is_manager' => in_array($teacherId, $mangerIds) ? 1 : 0,
                    ]
                );
            }
        }

        foreach ($configs[UserSeeder::class] as $item) {
            if (isset($item['@school'])) {
                $student = Student::whereEmail($item['email'])->first();
                $student->school_id = School::whereName($item['@school'])->first()->id;
                $student->save();
            }
        }
    }
}
