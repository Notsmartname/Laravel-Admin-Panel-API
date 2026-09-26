<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_their_password(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'password' => Hash::make('old-password'),
        ]);

        $response = $this
            ->actingAs($admin)
            ->put('/password', [
                'current_password' => 'old-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertTrue(
            Hash::check('new-password', $admin->refresh()->password)
        );
    }

    public function test_regular_user_can_update_their_password(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
            'password' => Hash::make('old-password'),
        ]);

        $response = $this
            ->actingAs($user)
            ->put('/password', [
                'current_password' => 'old-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertTrue(
            Hash::check('new-password', $user->refresh()->password)
        );
    }

    public function test_password_cannot_be_updated_with_wrong_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('password.update'), [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response->assertSessionHasErrorsIn(
            'updatePassword',
            'current_password'
        );

        $this->assertTrue(
            Hash::check('old-password', $user->refresh()->password)
        );
    }
}
