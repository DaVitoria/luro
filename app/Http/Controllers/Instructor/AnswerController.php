<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
  /**
   /**
   * Display a listing of the resource.
   */
  public function index(Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question)
  {
    $answers = $question->answers()->get();
    return view(
      'instructor.answers.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'question' => $question, 'answers' => $answers]
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question)
  {
    return view(
      'instructor.answers.create',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'question' => $question]
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question)
  {
    $input = $request->validate([
      'content' => ['required', 'string', 'min:2'],
      'is_correct' => ['sometimes', 'required'],
    ]);


    if ($question->type->isOpen()) {
      return back()->withError('A questão é aberta!');
    }

    $correct_answer = $question->answers()->getQuery()->where('is_correct', true)->first('id');
    if ($correct_answer && $request->has('is_correct')) {
      return back()->withError('Já tem um resposta correta!');
    }

    $input['is_correct'] = $request->has('is_correct');

    $output = $question->answers()->create($input);

    if (!$output) {
      return back()->withError('Registo não salvo!');
    }

    return to_route(
      'instructor.courses.answers.index',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'question' => $question]
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
  public function edit(Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question, Answer $answer)
  {
    return view(
      'instructor.answers.edit',
      ['course' => $course, 'module' => $module, 'lesson' => $lesson, 'quiz' => $quiz, 'question' => $question, 'answer' => $answer]
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question, Answer $answer)
  {
    $input = $request->validate([
      'content' => ['required', 'string', 'min:2'],
      'is_correct' => ['sometimes', 'required'],
    ]);


    $correct_answer = $question->answers()->getQuery()->where('is_correct', true)->first('id');
    if ($correct_answer && $request->has('is_correct')) {
      return back()->withError('Já tem um resposta correta!');
    }

    $input['is_correct'] = $request->has('is_correct');

    $output = $answer->update($input);

    if (!$output) {
      return back()->withError('Registo não atualizado!');
    }

    return to_route(
      'instructor.courses.answers.index',
      [
        'course' => $course,
        'module' => $module,
        'lesson' => $lesson,
        'quiz' => $quiz,
        'question' => $question
      ]
    )->withSuccess('Registo atualizado!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, Course $course, Module $module, Lesson $lesson, Quiz $quiz, Question $question, Answer $answer)
  {
    $output = $answer->delete();

    if (!$output) {
      return back()->withError('Registo não excluido!');
    }

    return back()->withSuccess('Registo excluido!');
  }
}
