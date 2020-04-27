<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Bug',
            'color' => 'red',
        ]);

        Category::create([
            'name' => 'Implementação',
            'color' => 'blue',
        ]);

        Category::create([
            'name' => 'Melhoria',
            'color' => 'green',
        ]);
    }
}
