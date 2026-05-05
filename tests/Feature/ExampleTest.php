<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_welcome_page(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('GC-EMS');
    }

    public function test_student_can_register_once_for_an_available_event(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $event = Event::create([
            'title' => 'Orientation',
            'description' => 'New student orientation.',
            'starts_at' => now()->addDay(),
            'venue' => 'Auditorium',
            'maximum_capacity' => 2,
        ]);

        $this->actingAs($student)
            ->post(route('events.register', $event))
            ->assertSessionHas('status', 'Registration confirmed.');

        $this->actingAs($student)
            ->post(route('events.register', $event))
            ->assertSessionHasErrors('registration');

        $this->assertCount(1, $student->fresh()->registeredEvents);
    }

    public function test_student_cannot_register_when_event_is_full(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $registeredStudent = User::factory()->create(['role' => 'student']);
        $event = Event::create([
            'title' => 'Workshop',
            'description' => 'Capacity limited workshop.',
            'starts_at' => now()->addDay(),
            'venue' => 'Room 101',
            'maximum_capacity' => 1,
        ]);

        $registeredStudent->registeredEvents()->attach($event, ['registered_at' => now()]);

        $this->actingAs($student)
            ->post(route('events.register', $event))
            ->assertSessionHasErrors('registration');
    }

    public function test_public_registration_always_creates_student_accounts(): void
    {
        $this->post(route('register'), [
            'name' => 'New User',
            'email' => 'new@example.com',
            'role' => 'admin',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'new@example.com',
            'role' => 'student',
        ]);
    }

    public function test_admin_cannot_access_user_management(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('users.index'))
            ->assertForbidden();
    }

    public function test_admin_can_create_event_with_cloudinary_image(): void
    {
        Http::fake([
            'api.cloudinary.com/*' => Http::response([
                'secure_url' => 'https://res.cloudinary.com/demo/image/upload/gcems/events/orientation.jpg',
            ]),
        ]);

        config([
            'services.cloudinary.cloud_name' => 'demo',
            'services.cloudinary.api_key' => 'key',
            'services.cloudinary.api_secret' => 'secret',
            'services.cloudinary.event_folder' => 'gcems/events',
        ]);

        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('events.store'), [
                'title' => 'Orientation',
                'description' => 'New student orientation.',
                'starts_at' => now()->addDay()->format('Y-m-d H:i:s'),
                'venue' => 'Auditorium',
                'maximum_capacity' => 120,
                'event_image' => UploadedFile::fake()->image('orientation.jpg')->size(500),
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Event created successfully.');

        $this->assertDatabaseHas('events', [
            'title' => 'Orientation',
            'image_url' => 'https://res.cloudinary.com/demo/image/upload/gcems/events/orientation.jpg',
        ]);
    }

    public function test_admin_can_update_event_without_replacing_existing_image(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::create([
            'title' => 'Workshop',
            'description' => 'Capacity limited workshop.',
            'starts_at' => now()->addDay(),
            'venue' => 'Room 101',
            'maximum_capacity' => 50,
            'image_url' => 'https://res.cloudinary.com/demo/image/upload/gcems/events/workshop.jpg',
        ]);

        $this->actingAs($admin)
            ->put(route('events.update', $event), [
                'title' => 'Updated Workshop',
                'description' => 'Updated details.',
                'starts_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
                'venue' => 'Room 102',
                'maximum_capacity' => 75,
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'Event updated successfully.');

        $this->assertSame('https://res.cloudinary.com/demo/image/upload/gcems/events/workshop.jpg', $event->fresh()->image_url);
    }

    public function test_super_admin_can_view_dashboard(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);

        $this->actingAs($superAdmin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Super Admin Portal');
    }

    public function test_super_admin_can_assign_admin_role(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($superAdmin)
            ->patch(route('users.update-role', $student), ['role' => 'admin'])
            ->assertSessionHas('status');

        $this->assertSame('admin', $student->fresh()->role);
    }

    public function test_super_admin_cannot_be_downgraded(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);

        $this->actingAs($superAdmin)
            ->patch(route('users.update-role', $superAdmin), ['role' => 'student'])
            ->assertSessionHasErrors('role');

        $this->assertSame('super_admin', $superAdmin->fresh()->role);
    }
}
