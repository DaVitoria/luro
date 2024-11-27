<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

  public function run(): void
  {
    Category::create(['name' => 'Aplicativo móvel']);
    Category::create(['name' => 'Negócios']);
    Category::create(['name' => 'Fotografia']);
    Category::create(['name' => 'Saúde']);
  }
}
