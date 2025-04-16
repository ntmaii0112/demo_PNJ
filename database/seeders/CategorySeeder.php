<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Nhẫn','Dây chuyền','Bông tai','Vòng tay'];
        foreach ($categories as $category) {
            Category::firstOrCreate(['name'=>$category]);
        }
    }
}
