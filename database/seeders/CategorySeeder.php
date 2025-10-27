<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Academic',
            'Event',
            'Urgent',
            'General',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
