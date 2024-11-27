<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
  public function redirect()
  {
      return Socialite::driver('github')
          ->scopes(['read:user', 'user:email'])
          ->redirect();
  }
  /**
   * Recebe o callback do GitHub e processa a autenticação.
   */
  public function callback()
  {
      try {
          // Obtém os dados do usuário do GitHub
          $githubUser = Socialite::driver('github')->user();
          // Procura ou cria o usuário com base no ID do GitHub
          $user = User::updateOrCreate(
              ['github_id' => $githubUser->getId()],
              [
                  'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                  'email' => $githubUser->getEmail(),
                  'avatar' => $githubUser->getAvatar(),
                  'github_token' => $githubUser->token,
                  'github_refresh_token' => $githubUser->refreshToken,
                  // Cria uma senha aleatória para satisfazer a validação do banco
                  'password' => bcrypt('github'),
              ]
          );
          // Faz login com o usuário
          Auth::login($user, true);

    return redirect()->intended('/');
      } catch (Exception $e) {
          // Log do erro para debug
          logger()->error('GitHub Login Error', [
              'message' => $e->getMessage(),
              'trace' => $e->getTraceAsString()
          ]);
          // Redireciona de volta para o login com mensagem de erro
          return redirect('/login')
              ->withErrors(['github' => 'Não foi possível fazer login com GitHub. Por favor, tente novamente.']);
      }
  }
  /**
   * Desconecta o usuário da conta do GitHub (mantém a conta local).
   */
  public function disconnect(Request $request)
  {
      $user = $request->user();

      $user->update([
          'github_id' => null,
          'github_token' => null,
          'github_refresh_token' => null,
      ]);
      return redirect()
          ->route('profile.edit')
          ->with('status', 'github-disconnected');
  }
}
