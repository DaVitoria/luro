<?php

namespace App\Http\Controllers\Instructor;

use App\Enum\PaymentStatus;
use App\Enum\SubscriptionStatus;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
  public function pending()
  {
    $user = Auth::user();
    $subscriptions = $user->coursesubs()->with(['user', 'course'])
      ->where('subscriptions.status', SubscriptionStatus::PENDING->value)
      ->orWhere('subscriptions.status', SubscriptionStatus::CANCELED->value)
      ->get();
    return view('instructor.subscription.pending', ['subscriptions' => $subscriptions]);
  }
  public function paid()
  {
    $user = Auth::user();
    $subscriptions = $user->coursesubs()->with(['user', 'course', 'payment'])
      ->where('subscriptions.status', SubscriptionStatus::ACTIVE->value)
      ->orWhere('subscriptions.status', SubscriptionStatus::COMPLETED->value)
      ->get();
    return view('instructor.subscription.paid', ['subscriptions' => $subscriptions]);
  }

  public function confirm(Subscription $subscription)
  {
    $subscription = $subscription->load('course');

    if (
      $subscription->status->isActive() ||
      $subscription->status->isCompleted()
    ) {
      return back()->withError('O aluno já pagou o curso!');
    }

    $subscription->update([
      'status' => SubscriptionStatus::ACTIVE->value,
    ]);
    $subscription->payment()->create([
      'value' => $subscription->course->price
    ]);
    return back()->withSuccess('Pagamento confirmado!');
  }

  public function reconfirm(Subscription $subscription)
  {
    $subscription = $subscription->load('course');

    if (!$subscription->status->isCanceled()) {
      return back()->withError('O aluno não cancelou o pagamento o curso!');
    }

    $subscription->update([
      'status' => SubscriptionStatus::ACTIVE->value,
    ]);

    $subscription->payment()->create([
      'value' => $subscription->course->price
    ]);
    return back()->withSuccess('Pagamento re confirmado!');
  }

  public function cancel(Subscription $subscription)
  {
    $subscription = $subscription->load('course');

    if (
      $subscription->status->isCanceled()
    ) {
      return back()->withError('O aluno já cancelou o pagamento!');
    }

    $subscription->update([
      'status' => SubscriptionStatus::CANCELED->value,
    ]);
    if ($subscription->payment) {
      $subscription->payment()->delete();
    };
    return back()->withSuccess('Pagamento cancelado!');
  }
}
