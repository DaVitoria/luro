<?php

namespace App\Http\Controllers;

use App\Enum\CourseStatus;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): View
  {
    $latest_courses = Course::query()
      ->with('category')
      ->withCount(['modules', 'lessons'])
      ->where('status', CourseStatus::APPROVED->value)->latest()->limit(4)->get();
    return view('home', ['latest_courses' => $latest_courses]);
  }
}
