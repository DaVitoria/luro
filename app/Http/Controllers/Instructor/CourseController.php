<?php

namespace App\Http\Controllers\Instructor;

use App\Enum\CourseStatus;
use App\Enum\Role;
use App\Enum\SubscriptionStatus;
use App\Enum\Tier;
use App\Enum\Validity;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $courses = Course::query()
      ->withCount(
        [
          'subscriptions as active_subs' => fn ($query) => $query->where('status', SubscriptionStatus::ACTIVE->value),
          'subscriptions as pending_subs' => fn ($query) => $query->where('status', SubscriptionStatus::PENDING->value)
        ],

      )
      ->paginate(10);
    return view('instructor.courses.index', ['courses' => $courses]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view(
      'instructor.courses.create',
      ['categories' => Category::all(['id', 'icon', 'name'])]
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $input = $request->validate([
      'image' => ['required', Rule::imageFile()->max(2048)],
      'title' => ['required', 'string', 'min:2'],
      'description' => ['required', 'string', 'min:2'],
      'category_id' => ['required', Rule::exists(Category::class, 'id')],
      'price' => ['required', 'numeric', 'min:0'],
      'tier' => ['required', new Enum(Tier::class)],
      'validity' => ['required', new Enum(Validity::class)]
    ]);

    DB::beginTransaction();

      try {
          $image = $request->file('image')->store('courses', 'public');

          if (!$image) {
              return back()->withInput()->withErrors(['image' => 'Image not stored!']);
          }

          $course = Course::create([
              'user_id' => auth()->id(),
              'image' => $image,
              'title' => $input['title'],
              'description' => $input['description'],
              'category_id' => $input['category_id'],
              'price' => $input['price'],
              'tier' => $input['tier'],
              'validity' => $input['validity']
          ]);

          if (!$course) {
              return back()->withInput()->with(['error' => 'Unable to save data!']);
          }

          DB::commit();
          return redirect()->route('instructor.courses.index')->withInput()->withSuccess('Registo salvo!');
      } catch (\Exception $e) {
          DB::rollback();
          return back()->withInput()->with(['error' => 'Erro ao salvar o curso: ' . $e->getMessage()]);
      }
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
  public function edit(Course $course)
  {
    return view(
      'instructor.courses.edit',
      ['course' => $course, 'categories' => Category::all(['id', 'icon', 'name'])]
    );
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course)
  {
    $input = $request->validate(
      [
        'image' => ['sometimes', 'nullable',  Rule::imageFile()->max(2048)],
        'title' => ['required', 'string', 'min:2'],
        'description' => ['required', 'string', 'min:2'],
        'category_id' => ['required', Rule::exists(Category::class, 'id')],
        'price' => ['required', 'numeric', 'min:0'],
        'tier' => ['required', new Enum(Tier::class)],
        'validity' => ['required', new Enum(Validity::class)]
      ]
    );
    DB::beginTransaction();

      try {
          if ($request->hasFile('image')) {
              $image = $request->file('image')->store('course');

              if ($course->image && Storage::exists($course->image)) {
                  Storage::delete($course->image);
              }

              $input['image'] = $image;
          }

          $course->update($input);
          DB::commit();
          return redirect()->route('instructor.courses.index')->withInput()->withSuccess('Registo atualizado!');
      } catch (\Exception $e) {
          DB::rollback();
          return back()->withInput()->with(['error' => 'Erro ao atualizar o curso: ' . $e->getMessage()]);
      }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Course $course)
  {
    if (!$course->delete()) return back()->withError('Registo não excluído!');
    return back()->withSuccess('Registo excluído!');
  }

  public function send(Request $request, Course $course)
  {
    $course->update(['status' => CourseStatus::PENDING->value]);
    return back()->withSuccess('Enviado para revisão!');
  }

  public function addStudent(Request $request, Course $course)
  {
    $input = $request->validate(
      [
        'number' => ['required', Rule::exists(User::class, 'number')],
      ]
    );

    if (!$course->status->isApproved()) {
      return back()->withError('O Curso ainda não foi aprovado!');
    };

    $user = User::query()
      ->where('number', $input['number'])
      ->where('role', Role::STUDENT->value)
      ->first();

    if (!$user) {
      return back()->withError('Nenhum aluno com o numero fornecido encontrado!');
    }

    $subscription = $user->subscriptions()->getQuery()->where('course_id', $course->id)->first();
    if ($subscription) {
      return back()->withError('Aluno ja inscrito no curso!');
    }

    $subscription = $user->subscriptions()->create([
      'user_id' => $user->id,
      'course_id' => $course->id,
      'status' => SubscriptionStatus::PENDING,
    ]);

    if (!$subscription) {
      return back()->withError('Erro ao inscrever aluno!');
    }

    return back()->withSuccess('Aluno: ' . $user->first_name . ', inscrito!');
  }
}
