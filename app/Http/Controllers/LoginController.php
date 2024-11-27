<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
  // Método para login tradicional
  public function __invoke(Request $request): RedirectResponse
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    $user = User::where('email', $credentials['email'])->first();

    // Verifica se o usuário existe e a senha está correta
    if (!$user || !Auth::attempt($credentials)) {
      Log::warning('Tentativa de login falhou', ['email' => $credentials['email']]);
      return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
      ])->onlyInput('email');
    }

    // Verifica se o 2FA está ativado para o usuário
    if ($user->two_factor_enabled) {
      $user->two_factor_code = rand(100000, 999999);
      $user->two_factor_expires_at = now()->addMinutes(10);
      $user->save();

      Log::info('Código 2FA enviado', ['user_id' => $user->id]);

      Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));

      session(['auth.id' => $user->id]);

      return redirect()->route('two-factor.show');
    }

    Auth::login($user);
    $request->session()->regenerate();

    Log::info('Login bem-sucedido', ['user_id' => $user->id]);

    return redirect()->route('/home');
  }

  // Método para redirecionar ao GitHub
  public function redirectToGithub(): RedirectResponse
  {
    return Socialite::driver('github')->redirect();
  }

  // Método para processar o retorno do GitHub
  public function handleGithubCallback(): RedirectResponse
  {
    try {
      $githubUser = Socialite::driver('github')->user();
      $user = User::firstOrCreate(
        ['email' => $githubUser->getEmail()],
        [
          'name' => $githubUser->getName() ?? $githubUser->getNickname(),
          'password' => bcrypt(str()->random(16)), // Senha aleatória
          'github_id' => $githubUser->getId(),
        ]
      );

      Log::info('Login via GitHub', ['user_id' => $user->id, 'github_id' => $githubUser->getId()]);

      // Se 2FA estiver habilitado, envie código 2FA
      if ($user->two_factor_enabled) {
        $user->two_factor_code = rand(100000, 999999);
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));
        session(['auth.id' => $user->id]);

        return redirect()->route('two-factor.show');
      }

      // Faz login no usuário
      Auth::login($user);
      session()->regenerate();

      // Redireciona ao dashboard apropriado
      if ($user->role == 'administrator') {
        return redirect()->route('administrator.dashboard');
      } elseif ($user->role == 'instructor') {
        return redirect()->route('instructor.dashboard');
      } elseif ($user->role == 'student') {
        return redirect()->route('student.dashboard');
      }

      // Padrão para usuários sem papel específico
      return redirect()->intended('/');
    } catch (\Exception $e) {
      Log::error('Erro ao autenticar com o GitHub', ['error' => $e->getMessage()]);
      return redirect('/login')->with('error', 'Ocorreu um erro ao autenticar com o GitHub.');
    }
  }
}
