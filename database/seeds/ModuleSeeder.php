<?php

use App\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geral = [
            'name' => "Geral",
            'description' => "Discussão geral sem tema em específico"
        ];

        Module::create([
            'name' => 'HTML',
        ])->subjects()->create($geral);

        Module::create([
            'name' => 'Git',
        ])->subjects()->create($geral);;
        Module::create([
            'name' => 'Scrum',
        ])->subjects()->create($geral);;
        Module::create([
            'name' => 'Js',
        ])->subjects()->create($geral);;
        Module::create([
            'name' => 'PHP',
        ])->subjects()->create($geral);;
        Module::create([
            'name' => 'Laravel',
        ])->subjects()->create($geral);;
        Module::create([
            'name' => 'React',
        ])->subjects()->create($geral);;
    }
}
