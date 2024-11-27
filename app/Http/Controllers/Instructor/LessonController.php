<?php

namespace App\Http\Controllers\Instructor;

use App\Enum\VideoPlatform;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class LessonController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Course $course, Module $module)
  {
    $module = $module->load('lessons');
    return view(
      'instructor.lessons.index',
      [
        'course' => $course,
        'module' => $module
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Course $course, Module $module)
  {
    return view('instructor.lessons.create', [
      'course' => $course,
      'module' => $module,
      'video_platforms' => VideoPlatform::toArray(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Course $course, Module $module)
  {
    $input = $request->validate([
      'title' => ['required', 'string', 'min:2'],
      'description' => ['required', 'string', 'min:2'],
      'lesson_number' => ['required', 'numeric', 'min:1'],
      'video_platform' => ['required', new Enum(VideoPlatform::class)],
      'video_url' => ['required', 'url']
    ]);

    $output = $module->lessons()->create($input);

    if (!$output) {
      return back()->withError('Aula não salva!');
    }

    return to_route('instructor.courses.lessons.index', ['course' => $course->id, 'module' => $module->id])->withSuccess('Aula criada');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Course $course, Module $module, Lesson $lesson)
  {
    return view('instructor.lessons.edit', [
      'course' => $course,
      'module' => $module,
      'lesson' => $lesson,
      'video_platforms' => VideoPlatform::toArray(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course, Module $module, Lesson $lesson)
  {
    $input = $request->validate([
      'title' => ['required', 'string', 'min:2'],
      'description' => ['required', 'string', 'min:2'],
      'lesson_number' => ['required', 'numeric', 'min:1'],
      'video_platform' => ['required', new Enum(VideoPlatform::class)],
      'video_url' => ['required', 'url']
    ]);

    $output = $lesson->update($input);

    if (!$output) {
      return back()->withError('Aula não atualizada!');
    }

    return to_route('instructor.courses.lessons.index', ['course' => $course->id, 'module' => $module->id])->withSuccess('Aula atualizada');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Course $course, Module $module, Lesson $lesson)
  {
    $output = $lesson->delete();

    if (!$output) {
      return back()->withError('Aula não excluida!');
    }

    return back()->withSuccess('Aula excluida');
  }
}
