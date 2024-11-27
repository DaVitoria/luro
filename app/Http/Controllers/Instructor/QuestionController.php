<?php

namespace App\Http\Controllers\Instructor;

use App\Enum\QuestionType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class QuestionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Course $course, Module $module, Lesson $lesson, Quiz $quiz)
  {
    $questions = $quiz->questions()->get();
    return view(
      'instructor.questions.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'questions' => $questions]
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Course $course, Module $module, Lesson $lesson, Quiz $quiz)
  {
    return view(
      'instructor.questions.create',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'question_types' => QuestionType::toArray()]
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz)
  {
    $input = $request->validate([
      'content' => ['required', 'string', 'min:2'],
      'type' => ['required', new Enum(QuestionType::class)],
    ]);

    $output = $quiz->questions()->create($input);

    if (!$output) {
      return back()->withError('Registo não salvo!');
    }

    return to_route(
      'instructor.courses.questions.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz]
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
  public function edit(Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question)
  {
    return view(
      'instructor.questions.edit',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'question' => $question, 'question_types' => QuestionType::toArray()]
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question)
  {
    $input = $request->validate([
      'content' => ['required', 'string', 'min:2'],
      'type' => ['required', new Enum(QuestionType::class)],
    ]);

    if (
      $input['type'] === QuestionType::OPEN->value
      && count($question->answers()->get('id')) > 0
    ) {
      return back()->withError('A questão tem respostas não pode ser aberta!');
    };

    $output = $question->update($input);

    if (!$output) {
      return back()->withError('Registo não atualizado!');
    }

    return to_route(
      'instructor.courses.questions.index',
      [
        'course' => $course,
        'module' => $module,
        'lesson' => $lesson,
        'quiz' => $quiz
      ]
    )->withSuccess('Registo atualizado!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question)
  {
    $output = $question->delete();

    if (!$output) {
      return back()->withError('Registo não excluido!');
    }

    return back()->withSuccess('Registo excluido!');
  }
}
