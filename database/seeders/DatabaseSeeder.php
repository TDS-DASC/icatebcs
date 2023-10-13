<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BankSeeder::class);
        $this->call(CenterSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(StudentSeeder::class);
        //$this->call(AddressSeeder::class);
        //\App\Models\Address::factory(5)->create();
        $this->call(UserSeeder::class);
        //\App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);

        $this->call(InstructorSeeder::class);
        $this->call(TrainingFieldSeeder::class);
        $this->call(CourseSeeder::class);
        
        $this->call(DaySeeder::class);
        $this->call(GroupSeeder::class);
    }
}
