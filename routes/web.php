<?php

use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\Administrator\CourseController as AdministratorCourseController;
use App\Http\Controllers\Administrator\InstructorController as AdministratorInstructorController;
use App\Http\Controllers\Administrator\OverviewController as AdministratorOverviewController;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\TwoFactorAuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;
use App\Http\Controllers\Instructor\LessonController as InstructorLessonController;
use App\Http\Controllers\Instructor\OverviewController as InstructorOverviewController;
use App\Http\Controllers\Instructor\ModuleController as InstructorModuleController;
use App\Http\Controllers\Instructor\StudentController as InstructorStudentController;
use App\Http\Controllers\Instructor\SubscriptionController as InstructorSubscriptionController;
use App\Http\Controllers\Instructor\SupportMaterialController as InstructorSupportMaterialController;
use App\Http\Controllers\Instructor\QuizController as InstructorQuizController;
use App\Http\Controllers\Instructor\QuestionController as InstructorQuestionController;
use App\Http\Controllers\Instructor\AnswerController as InstructorAnswerController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Student\SubscriptionController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\Instructor;
use App\Models\SupportMaterial;
use Illuminate\Support\Facades\Route;



Route::get('/', HomeController::class)->name('home');

Route::resource('courses', CourseController::class)->only(['index', 'show']);

Route::middleware(['guest'])->group(function () {
  Route::get('/login', fn () => view('login'))->name('login');
  Route::post('/login', LoginController::class);
  Route::get('/register', fn () => view('register'))->name('register');
  Route::post('/register', RegisterController::class);
});

Route::middleware(['auth'])->group(function () {
  Route::delete('/logout', LogoutController::class)->name('logout');

  Route::get('instructors/{user}', [InstructorController::class, 'show'])->name('instructor.show');
  Route::get('students/{user}', [StudentController::class, 'show'])->name('student.show');

  Route::get('/settings', [ProfileController::class, 'account'])->name('settings.account');
  Route::post('/settings', [ProfileController::class, 'account_update']);
  Route::post('/settings/password', [ProfileController::class, 'password'])->name('settings.password');
});


  Route::get('/two-factor', [TwoFactorAuthController::class, 'show'])->name('two-factor.show');
  Route::post('/two-factor/verify', [TwoFactorAuthController::class, 'verify'])->name('two-factor.verify');
  Route::get('/two-factor/resend', [TwoFactorAuthController::class, 'resend'])->name('two-factor.resend');

  Route::get('/callback', [LoginController::class, 'redirectToGithub'])->name('github.login');
  Route::get('/callback/github', [LoginController::class, 'handleGithubCallback'])->name('github.callback');

  Route::prefix('administrator')->middleware(['auth', 'administrator'])->group(function () {

  Route::get('/dashboard', AdministratorOverviewController::class)->name('administrator.dashboard');
  Route::resource('categories', CategoryController::class)->names('administrator.categories');
  Route::get('/courses/pending', [AdministratorCourseController::class, 'pending'])->name('administrator.courses.pending');
  Route::get('/courses/rejected', [AdministratorCourseController::class, 'rejected'])->name('administrator.courses.rejected');
  Route::post('/courses/{course}/approve', [AdministratorCourseController::class, 'approve'])->name('administrator.courses.approve');
  Route::post('/courses/{course}/reject', [AdministratorCourseController::class, 'reject'])->name('administrator.courses.reject');
  Route::get('/instructors', [AdministratorInstructorController::class, 'index'])->name('administrator.instructors.index');
});

Route::prefix('instructor')->middleware(['auth', 'instructor'])->group(function () {
  Route::get('/dashboard', InstructorOverviewController::class)->name('instructor.dashboard');

  Route::resource('courses', InstructorCourseController::class)->names('instructor.courses')->except(['show', 'addstudent']);
  Route::post('courses/{course}/student', [InstructorCourseController::class, 'addStudent'])->name('instructor.courses.addstudent');

  Route::prefix('courses/{course}')->group(function ()
  {
    Route::post('/send', [InstructorCourseController::class, 'send'])->name('instructor.courses.send');
    Route::resource('modules', InstructorModuleController::class)->names('instructor.courses.modules')->except('show');
    Route::prefix('modules/{module}')->group(function () {
      Route::resource('lessons', InstructorLessonController::class)->names('instructor.courses.lessons')->except('show');
      Route::prefix('lessons/{lesson}')->group(function () {
        Route::resource('support_materials', InstructorSupportMaterialController::class)->names('instructor.courses.support_materials')->except('show');
        Route::resource('quizzes', InstructorQuizController::class)->names('instructor.courses.quizzes')->except('show');
        Route::prefix('quizzes/{quiz}')->group(function () {
          Route::resource('questions', InstructorQuestionController::class)->names('instructor.courses.questions')->except('show');
          Route::prefix('questions/{question}')->group(function () {
            Route::resource('answers', InstructorAnswerController::class)->names('instructor.courses.answers')->except('show');
          });
        });
      });
    });
  });



  Route::resource('students', InstructorStudentController::class)->names('instructor.students')->only(['index']);


  Route::get('subscriptions/pending', [InstructorSubscriptionController::class, 'pending'])->name('instructor.subscriptions.pending');
  Route::get('subscriptions/paid', [InstructorSubscriptionController::class, 'paid'])->name('instructor.subscriptions.paid');
  Route::post('subscriptions/{subscription}/confirm', [InstructorSubscriptionController::class, 'confirm'])->name('instructor.subscriptions.confirm');
  Route::post('subscriptions/{subscription}/reconfirm', [InstructorSubscriptionController::class, 'reconfirm'])->name('instructor.subscriptions.reconfirm');
  Route::post('subscriptions/{subscription}/cancel', [InstructorSubscriptionController::class, 'cancel'])->name('instructor.subscriptions.cancel');
});

Route::prefix('student')->middleware(['auth', 'student'])->group(function () {

  Route::get('/dashboard', fn () => view('student.overview'))->name('student.dashboard');
  Route::resource('courses', StudentCourseController::class)->names('student.courses');
  Route::prefix('courses/{course}')->group(function () {
    Route::resource('modules', SubscriptionController::class)->names('student.courses.subscription')->only(['store', 'destroy']);
  });
});
