<?php

namespace Database\Seeders;

use App\Enum\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory(10)->create();

    User::factory()->create([
      'first_name' => 'Pernoca',
      'last_name' => 'dos Santos',
      'email' => 'teste@teste.com',
      'role' => Role::ADMINISTRATOR->value,
    ]);
    User::factory()->create([
      'first_name' => 'Dr. Valverdes',
      'last_name' => 'Pereira',
      'email' => 'val@teste.com',
      'role' => Role::INSTRUCTOR->value,
    ]);

    $this->call([
      CategorySeeder::class,
    ]);
  }
}
