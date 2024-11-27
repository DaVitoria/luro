<?php

namespace App\Http\Controllers\Administrator;

use App\Enum\CourseStatus;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Console\Output\Output;

class CourseController extends Controller
{
  public function pending(): View
  {
    $courses = Course::query()->with(['user', 'category'])->where('status', CourseStatus::PENDING->value)->paginate();
    return view('administrator.courses.pending', [
      'courses' => $courses
    ]);
  }
  public function rejected(): View
  {
    $courses = Course::query()->with(['user', 'category'])->where('status', CourseStatus::REJECTED->value)->paginate();
    return view('administrator.courses.rejected', [
      'courses' => $courses
    ]);
  }


  public function approve(Request $request, Course $course): RedirectResponse
  {
    $output = $course->update(['status' => CourseStatus::APPROVED->value]);
    if (!$output) return back()->withError('couldn\'t  approve');
    return back()->withSuccess('Success approved');
  }

  public function reject(Request $request, Course $course): RedirectResponse
  {
    $output = $course->update(['status' => CourseStatus::REJECTED->value]);
    if (!$output) return back()->withError('couldn\'t reject');
    return back()->withSuccess('Success rejected');
  }
}
