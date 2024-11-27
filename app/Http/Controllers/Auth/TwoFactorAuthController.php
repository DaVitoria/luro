<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFactorAuthController extends Controller
{
  public function show()
  {
      return view('auth.two-factor');
  }

  public function verify(Request $request)
  {
      $request->validate([
          'two_factor_code' => ['required', 'numeric'],
      ]);

      $user = User::find(session('auth.id'));

      if (!$user || $user->two_factor_code !== $request->two_factor_code || now()->greaterThan($user->two_factor_expires_at)) {
          return redirect()->route('two-factor.show')->withErrors(['two_factor_code' => 'Código inválido ou expirado.']);
      }

      $user->update([
          'two_factor_code' => null,
          'two_factor_expires_at' => null,
      ]);

      Auth::login($user);
      session()->forget('auth.id');

      return redirect()->intended('/');
  }

  public function resend(Request $request)
  {
      $userId = session('auth.id');
      if (!$userId) {
          return redirect()->route('login')->withErrors(['email' => 'Sessão expirada. Faça login novamente.']);
      }

      $user = User::find($userId);
      if (!$user) {
          return redirect()->route('login')->withErrors(['email' => 'Usuário não encontrado.']);
      }

      $user->two_factor_code = rand(100000, 999999);
      $user->two_factor_expires_at = now()->addMinutes(10);
      $user->save();

      Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code));

      return back()->with('status', 'Código reenviado para o seu e-mail.');
  }
}
