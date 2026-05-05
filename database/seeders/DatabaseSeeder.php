<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gcems.test',
                'role' => 'super_admin',
                'password' => Hash::make('superadmin123'),
            ],
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@gcems.test'],
            [
                'name' => 'Event Manager',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
        );

        $student = User::updateOrCreate(
            ['email' => 'student@gcems.test'],
            [
                'name' => 'Student User',
                'role' => 'student',
                'password' => Hash::make('password'),
            ],
        );

        $events = collect([
            [
                'title' => 'Campus Leadership Summit',
                'description' => 'A school-wide seminar for student leaders focused on planning, communication, and responsible event participation.',
                'starts_at' => now()->addDays(3)->setTime(9, 0),
                'venue' => 'Main Auditorium',
                'maximum_capacity' => 120,
            ],
            [
                'title' => 'Science Fair Orientation',
                'description' => 'Orientation for participants joining the annual science fair, including booth rules and project submission reminders.',
                'starts_at' => now()->addWeek()->setTime(13, 30),
                'venue' => 'STEM Laboratory',
                'maximum_capacity' => 60,
            ],
            [
                'title' => 'Intramurals Opening Program',
                'description' => 'Opening program for school intramurals with team parade, announcements, and activity briefings.',
                'starts_at' => now()->addWeeks(2)->setTime(8, 0),
                'venue' => 'Covered Court',
                'maximum_capacity' => 300,
            ],
        ])->map(fn ($data) => Event::updateOrCreate(
            ['title' => $data['title']],
            $data,
        ));

        $student->registeredEvents()->syncWithoutDetaching([
            $events->first()->id => ['registered_at' => now()],
        ]);
    }
}
