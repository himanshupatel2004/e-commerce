<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        $categories = ['Electronics','Clothing'];
        foreach ($categories as $category) {
          $cat = New Category;
          $cat->name = $category;
          $cat->save();
        }
    }
}
