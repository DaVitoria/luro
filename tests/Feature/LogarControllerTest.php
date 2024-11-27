<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_login_com_credenciais_validas()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/', [
            'email' => 'test@teste.com',
            'password' => 'password',
        ]);


        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function test_login_com_credenciais_invalidas()
    {

        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);


        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);


        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function test_login_com_2fa_ativado()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'two_factor_enabled' => true,
        ]);

        Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);


        $response->assertRedirect(route('two-factor.show'));

        Mail::assertSent(TwoFactorCodeMail::class);
        $this->assertEquals(session('auth.id'), $user->id);
    }
}
