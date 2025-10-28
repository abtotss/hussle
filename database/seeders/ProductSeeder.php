<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // create 40 products
        $products = Product::factory()->count(40)->create();

        $categoryIds = Category::pluck('id')->toArray();

        if (count($categoryIds) === 0) {
            // no categories exist — exit or create defaults
            return;
        }

        // attach each product to 1-3 random categories (use sync to be idempotent)
        foreach ($products as $product) {
            $attach = collect($categoryIds)->random(rand(1, min(3, count($categoryIds))))->toArray();
            $product->categories()->sync($attach);
        }
    }
}
