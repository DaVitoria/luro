<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    $categories = Category::query()->withCount(['courses'])->get();

    return view(
      'administrator.categories.index',
      [
        'categories' => $categories,
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view(
      'administrator.categories.create',
    );
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $input = $request->validate([
      'name' => ['required', 'string', Rule::unique('categories', 'name')]
    ]);
    $output = Category::create($input);
    if (!$output) return back()->withInput()->withError('Registo não salvo!');
    return redirect()->route('administrator.categories.index')->withSuccess('Registo salvo!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category): View
  {
    $categories = Category::withCount('courses')->get();
    $courses = $category->courses()->with('user')->latest('updated_at')->paginate(10);
    return view(
      'administrator.categories.show',
      [
        'categories' => $categories,
        'category' => $category,
        'courses' => $courses,
      ]
    );
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {

    return view(
      'administrator.categories.edit',
      ['category' => $category]
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    $input = $request->validate([
      'name' => ['required', 'string', Rule::unique('categories', 'name')->ignore($category->id)]
    ]);
    $output = $category->update($input);
    if (!$output) return  back()->withInput()->withError('Registo não excluído!');
    return redirect()->route('administrator.categories.index')->withSuccess('Registo atualizado!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    if (!$category->delete()) return back()->withError('Registo não excluído!');
    return back()->withSuccess('Registo excluído!');
  }
}
