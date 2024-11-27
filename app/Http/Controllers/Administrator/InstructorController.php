<?php

namespace App\Http\Controllers\Administrator;

use App\Enum\Role;
use App\Enum\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $instructors = User::query()
      ->where('role', Role::INSTRUCTOR->value)
      ->withCount('courses')
      ->withCount(['subscriptions' => fn ($query) => $query->where('status', SubscriptionStatus::ACTIVE->value)])
      ->get();
    return view('administrator.instructors.index', ['instructors' => $instructors]);
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
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
  }
}
