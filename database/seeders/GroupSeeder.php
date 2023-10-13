<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Course;
use App\Models\Day;
use App\Models\Instructor;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $days = Day::all();
        $course = Course::limit(2)->get();
        $instructor = Instructor::limit(2)->get();
        
        
        $group = Group::create([
            'key' => '23-UC-LAP-000',
            'center_id' => $instructor->get(0)->center->id,
            'course_id' => 1,
            'instructor_id' => $instructor->get(0)->id,
            'place_id' => 270,
            'date_start' => now(),
            'date_end' => Carbon::now()->addMonth(),
            'time_start' => now(),
            'time_end' => Carbon::now()->addHours(4),
        ]);
        $course->get(0)->instructors()->sync($instructor->get(0));
        $students = Student::select('id')->get()->random(5);
        $group->students()->sync($students);
        $group->days()->attach($days->random(4));
        $group->save();

        $group = Group::create([
            'key' => '23-UC-LAP-001',
            'center_id' => $instructor->get(1)->center->id,
            'course_id' => 2,
            'instructor_id' => $instructor->get(0)->id,
            'place_id' => 270,
            'date_start' => now(),
            'date_end' => Carbon::now()->addMonths(2),
            'time_start' => now(),
            'time_end' => Carbon::now()->addHours(8),
        ]);

        $course->get(1)->instructors()->sync($instructor->get(1));
        $students = Student::select('id')->get()->random(3);
        $group->students()->sync($students);
        $group->days()->attach($days->random(3));
        $group->save();
    }
}
