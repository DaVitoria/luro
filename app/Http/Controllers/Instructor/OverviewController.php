<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $recent_courses = Course::query()->where('user_id', auth()->id())->with('user')->latest()->limit(5)->get();
    return view('instructor.overview', ['recent_courses' => $recent_courses]);
  }
}
