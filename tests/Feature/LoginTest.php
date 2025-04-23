<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'address' =>'Hà Nội',
            'dob' => '2003-12-01',
            'status' => 1,
            'captcha' => "",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /** @test */
    public function it_shows_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        Log::shouldReceive('info')
            ->once()
            ->with('Login success', ['email' => 'test@example.com']);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('products.public'));
        $response->assertSessionHas('success', 'Login success!');
        $this->assertAuthenticatedAs($this->user);
    }

    /** @test */
    public function user_cannot_login_with_incorrect_password()
    {
        Log::shouldReceive('info')
            ->once()
            ->with('Login failed', ['email' => 'test@example.com']);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email' => 'Thông tin đăng nhập không đúng']);
        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_unregistered_email()
    {
        Log::shouldReceive('info')
            ->once()
            ->with('Login failed', ['email' => 'nonexistent@example.com']);

        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['email' => 'Thông tin đăng nhập không đúng']);
        $this->assertGuest();
    }

    /** @test */
    public function it_shows_forgot_password_form()
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
        $response->assertViewIs('auth.forgot-password');
    }

    /** @test */
    public function user_can_logout()
    {
        // First login the user
        $this->actingAs($this->user);

        Log::shouldReceive('info')
            ->once()
            ->with('Người dùng đã đăng xuất', [
                'user_id' => $this->user->id,
                'email' => $this->user->email,
                'ip_address' => request()->ip(),
                'time' => now(),
            ]);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_cannot_access_login_page()
    {
        $this->actingAs($this->user);

        $response = $this->get('/login');

        $response->assertRedirect(route('products.public'));
    }
}
