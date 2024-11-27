<?php

namespace App\Http\Controllers;

use App\Enum\CourseStatus;
use App\Enum\SubscriptionStatus;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $courses = Course::query()->where('status', CourseStatus::APPROVED->value)->paginate();
    return view('courses.index', ['courses' => $courses]);
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
  public function show(Course $course)
  {
    $user = auth()->user();
    $subscriptionStatus = null;
    $course =  $course->load([
      'user',
    ])
      ->loadCount([
        'subscriptions' => fn ($query) => $query->where('status', SubscriptionStatus::ACTIVE->value),
        'modules',
        'lessons'
      ]);


    if ($user) {
      $subscriptions = $course->subscriptions->where('user_id', $user->id);

      if ($subscriptions->isNotEmpty()) {
        $subscriptionStatus = $subscriptions->first()->status;
      }
    }


    $recommended = Course::with('category:id,name')
      ->withCount([
        'modules',
        'lessons'
      ])
      ->where('status', CourseStatus::APPROVED->value)
      ->whereNot('id', $course->id)->limit(5)->get();
    return view(
      'courses.show',
      [
        'course' => $course,
        'recommended' => $recommended,
        'subscriptionStatus' => $subscriptionStatus
      ]
    );
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Course $course)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Course $course)
  {
    //
  }
}
