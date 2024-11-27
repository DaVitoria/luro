<?php

namespace App\Http\Controllers\Instructor;

use App\Enum\SupportMaterialType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\SupportMaterial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SupportMaterialController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Course $course, Module $module, Lesson $lesson)
  {
    return view(
      'instructor.suportmaterial.index',
      [
        'course' => $course,
        'module' => $module,
        'lesson' => $lesson
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Course $course, Module $module, Lesson $lesson)
  {
    return view('instructor.suportmaterial.create', [
      'course' => $course,
      'module' => $module,
      'lesson' => $lesson,
      'material_types' => SupportMaterialType::toArray(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request, Course $course, Module $module, Lesson $lesson)
  {
    $input = $request->validate([
      'name' => ['required', 'string', 'min:2'],
      'material_type' => ['required', new Enum(SupportMaterialType::class)],
      'link_material' => ['required', 'url']
    ]);

    $output = $lesson->supportMaterials()->create($input);

    if (!$output) {
      return back()->withError('Registo não salvo!');
    }

    return to_route('instructor.courses.support_materials.index', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id])->withSuccess('Registo salvo');
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
  public function edit(Course $course, Module $module, Lesson $lesson, SupportMaterial $support_material)
  {
    return view('instructor.suportmaterial.edit', [
      'course' => $course,
      'module' => $module,
      'lesson' => $lesson,
      'sm' => $support_material,
      'material_types' => SupportMaterialType::toArray(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Course $course, Module $module, Lesson $lesson, SupportMaterial $support_material)
  {
    $input = $request->validate([
      'name' => ['required', 'string', 'min:2'],
      'material_type' => ['required', new Enum(SupportMaterialType::class)],
      'link_material' => ['required', 'url']
    ]);

    $output = $support_material->update($input);

    if (!$output) {
      return back()->withError('Registo não atualizada!');
    }

    return to_route('instructor.courses.support_materials.index', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id])->withSuccess('Registo atualizada');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Course $course, Module $module, Lesson $lesson, SupportMaterial $support_material)
  {
    $output = $support_material->delete();

    if (!$output) {
      return back()->withError('Registo não excluido!');
    }

    return back()->withSuccess('Registo excluido');
  }
}
