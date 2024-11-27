<?php

namespace App\Http\Controllers\Instructor;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function index(): View
  {
    $students = User::query()
      ->withCount(['courses' => fn (Builder $q) => $q->where(['user_id', auth()->id()])])
      ->where('role', Role::STUDENT->value)
      ->paginate(10);
    return view('instructor.students.index', ['students' => $students]);
  }
}
