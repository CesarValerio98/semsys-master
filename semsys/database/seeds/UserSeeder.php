<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'Raymundo',
            'f_surname' => 'Aparicio',
            's_surname' => 'Olarte',
            'phone' => '7661152096',
            'email' => '16610220@utgz.edu.mx',
            'password' => Hash::make('12345678'),
            'image' => '',
            'role_id' => 1,
            ],
            [
            'name' => 'Cesar Antonio',
            'f_surname' => 'Hernández',
            's_surname' => 'Valerio',
            'phone' => '7841123748',
            'email' => '16610437@utgz.edu.mx',
            'password' => Hash::make('12345678'),
            'image' => '',
            'role_id' => 1,
            ],
            [
            'name' => 'LUIS FELIPE',
            'f_surname' => 'SÁNCHEZ',
            's_surname' => 'GARCÍA',
            'phone' => '7661152096',
            'email' => '18610022@utgz.edu.mx',
            'password' => Hash::make('12345678'),
            'image' => '',
            'role_id' => 1,
            ],
        ]);
    }
}
