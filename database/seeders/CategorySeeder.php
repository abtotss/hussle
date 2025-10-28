<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product; // assume this exists

class CategorySeeder extends Seeder
{
    public function run()
    {
        $cats = [
            ['name'=>'Electronics','slug'=>'electronics','description'=>'Gadgets & devices'],
            ['name'=>'Clothing','slug'=>'clothing','description'=>'Wearables & apparel'],
            ['name'=>'Home','slug'=>'home','description'=>'Home & kitchen'],
        ];

        foreach ($cats as $c) {
            $category = Category::create($c);

            // attach up to 3 random products if products exist:
            if (Product::count()) {
                $productIds = Product::inRandomOrder()->limit(3)->pluck('id')->toArray();
                $category->products()->attach($productIds);
            }
        }
    }
}
