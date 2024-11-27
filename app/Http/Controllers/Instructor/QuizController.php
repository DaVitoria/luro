<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Course $course, Module $module, Lesson $lesson)
  {
    $quizzes = $lesson->quizzes()->withCount('questions')->get();
    return view(
      'instructor.quizzes.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quizzes' => $quizzes]
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Course $course, Module $module, Lesson $lesson)
  {
    return view(
      'instructor.quizzes.create',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson]
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Course $course, Module $module, Lesson $lesson)
  {
    $input = $request->validate([
      'title' => ['required', 'string', 'min:2'],
      'description' => ['required', 'string', 'min:2'],
    ]);

    $output = $lesson->quizzes()->create($input);

    if (!$output) {
      return back()->withError('Registo não salvo!');
    }

    return to_route(
      'instructor.courses.quizzes.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson]
    )->withSuccess('Registo salvo!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Quiz $quiz)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Course $course, Module $module, Lesson $lesson, Quiz $quiz)
  {
    return view(
      'instructor.quizzes.edit',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz]
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz)
  {
    $input = $request->validate([
      'title' => ['required', 'string', 'min:2'],
      'description' => ['required', 'string', 'min:2'],
    ]);

    $output = $quiz->update($input);

    if (!$output) {
      return back()->withError('Registo não atualizado!');
    }

    return to_route(
      'instructor.courses.quizzes.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson]
    )->withSuccess('Registo atualizado!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz)
  {
    $output = $quiz->delete();

    if (!$output) {
      return back()->withError('Registo não excluido!');
    }

    return back()->withSuccess('Registo excluido!');
  }
}
