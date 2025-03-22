<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;


class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics' => ['Mobile', 'Laptop', 'Washing Machine', 'Computer', 'Watch'],
            'Clothing' => ['Mans', 'Women', 'Children']
        ];

        foreach ($categories as $categoryName => $subCategories) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($subCategories as $subcategoryName) {
                $subcategory = SubCategory::firstOrNew([
                    'category_id' => $category->id,
                    'name' => $subcategoryName,
                ]);

                if(!$subcategory->exists) {
                    $subcategory->save();
                }
            }
        }

    }
}
