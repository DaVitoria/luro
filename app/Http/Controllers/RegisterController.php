<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
  public function __invoke(Request $request): RedirectResponse
  {
    $input = $request->validate([
      'first_name' => ['required', 'max:255'],
      'last_name' => ['required', 'max:255'],
      'email' => ['required', 'email'],
      'role' => ['required', Rule::in([Role::INSTRUCTOR->value, Role::STUDENT->value])],
      'password' => ['required', 'confirmed', Password::default()],
    ]);


    $user = User::create(array_merge(
      $input,
      ['number' => hexdec(uniqid()),]
    ));

    if (auth()->login($user)) {
      $request->session()->regenerate();
      return redirect('/');
    } else {
      return redirect()->route('login');
    }
  }
}
