<?php

namespace App\Http\Controllers\Administrator;

use App\Enum\CourseStatus;
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
    $pending_courses = Course::with('user')->where('status', CourseStatus::PENDING->value)->latest()->limit(5)->get();
    return view('administrator.overview', ['pending_courses' => $pending_courses]);
  }
}
