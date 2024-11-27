<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
  public function account(): View
  {
    $user = auth()->user();
    return view('settings.profile', ['user' => $user]);
  }

  public function account_update(Request $request): RedirectResponse
  {
    $user = auth()->user();
    $input = $request->validate(
      [
        'image' => ['sometimes', 'nullable',  Rule::imageFile()->max(2048)],
        'first_name' => ['required', 'string'],
        'last_name' => ['required', 'string'],
        'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
      ]
    );
    if ($request->hasFile('image')) {
      $image = $request->file('image')->store('user');

      if ($user->image && Storage::exists($user->image)) {
        Storage::delete($user->image);
      }

      $input['image'] = $image;
    }

    $user->update($input);
    return back()->withSuccess('Registo atualizado.');
  }

  public function password(Request $request): RedirectResponse
  {
    $input = $request->validate(
      [
        'current_password' => ['required', 'string'],
        'password' => [
          'required', 'confirmed', Password::default(),
        ]
      ]
    );
    $user = auth()->user();

    if (!Hash::check($input['current_password'], $user->password)) {
      return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    $user->update(['password' => Hash::make($input['password'])]);

    return back()->withSuccess('Palavra-passe atualizada.');
  }
}
