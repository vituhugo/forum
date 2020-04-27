<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'O Grande Poderoso',
            'email' => 'admin@digitalhouse.com',
            'username' => 'mestre',
            'avatar' => '/avatar.png',
            'password' => 'secret',
            'course_id' => null,
            'position_id' => 999,
        ]);

        factory(User::class, 10)->create();
    }
}
