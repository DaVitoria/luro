<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    RedirectIfAuthenticated::redirectUsing(fn (Request $request) => route('home'));
    Paginator::useBootstrapFive();
    Course::observe(new \App\Observers\CourseObserver());


    Gate::define('administrator', fn (User $user) => $user->role->isAdministrator());
    Gate::define('instrutor', fn (User $user) => $user->role->isInstructor());
    Gate::define('student', fn (User $user) => $user->role->isStudent());
  }
}
