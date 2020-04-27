<?php

use Illuminate\Database\Seeder;

use App\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'id' => 999,
            'name' => 'Mestre dos magos',
        ]);

        Position::create([
            'id' => 1,
            'name' => 'Uni',
        ]);
    }
}
