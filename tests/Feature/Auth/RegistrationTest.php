<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_users_creation_page(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this
            ->actingAs($admin)
            ->get(route('admin.users.create'));

        $response->assertStatus(200);
    }

    public function test_admin_can_create_new_user(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this
            ->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'Test User',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

        $response->assertRedirect(route('admin.users.index'));

        $response->assertSessionHas('success', 'Пользователь создан.');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
        ]);
    }

    public function test_regular_user_cannot_create_new_user(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('admin.users.store'), [
                'name' => 'Test User',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('users', [
            'name' => 'Test User',
        ]);
    }
}
