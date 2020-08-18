<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          User::create([
              'name' => 'Kwanok Noh',
              'email' => 'cloq@kakao.com',
              'password' => bcrypt('rhksdhr2!'),
              'role' => 'administrator'
          ]);
    }
}
