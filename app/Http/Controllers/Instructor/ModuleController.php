<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

  public function index(Course $course)
  {
    $modules = $course->modules()->with(['lessons' => fn ($q) => $q->orderBy('lesson_number', 'asc')])->get();
    return view('instructor.modules.index', ['course' => $course, 'modules' => $modules]);
  }

  public function create(Course $course)
  {
    return view('instructor.modules.create', ['course' => $course]);
  }

  public function edit(Course $course, Module $module)
  {
    return view('instructor.modules.edit', ['course' => $course, 'module' => $module]);
  }

  public function store(Request $request, Course $course)
  {
    $input = $request->validate([
      'name' => ['required', 'string']
    ]);
    $output = $course->modules()->create($input);
    if (!$output) return back()->withInput()->withError('Registo não salvo!');
    return redirect()->route('instructor.courses.modules.index', ['course' => $course->id])->withSuccess('Registo salvo!');
  }

  public function update(Request $request, Course $course, Module $module)
  {
    $input = $request->validate([
      'name' => ['required', 'string']
    ]);
    $output = $module->update($input);
    if (!$output) return back()->withInput()->withError('Registo não atualizado!');
    return redirect()->route('instructor.courses.modules.index', ['course' => $course->id])->withSuccess('Registo atualizado!');
  }

  public function destroy(Request $request, Course $course, Module $module)
  {
    if (!$module->delete()) return back()->withError('Registo não excluído!');
    return back()->withSuccess('Registo excluído!');
  }
}
