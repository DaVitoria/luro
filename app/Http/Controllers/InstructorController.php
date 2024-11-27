<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class InstructorController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    $user = User::query()->with('courses')->withCount('courses')->findOrFail($user->id);
    return view('instructor.show', ['user' => $user]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    return view('instructor.edit', ['user' => $user]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
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

    $user->updateOrFail($input);
    return back()->withSuccess('Update successful.');
  }

  public function password(Request $request, User $user)
  {
    $input = $request->validate(
      [
        'current_password' => ['required', 'string'],
        'password' => [
          'required', 'confirmed', Password::default(),
        ]
      ]
    );

    if (!Hash::check($input['current_password'], $user->password)) {
      return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    $user->update(['password' => Hash::make($input['password'])]);

    return back()->withSuccess('Password updated successfully.');
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    //
  }
}
