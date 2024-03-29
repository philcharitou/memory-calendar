<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Phil Charitou',
            'email' => 'passwordlogin@yoursite.com',
            'password' => Hash::make('cookies&cream'),
        ]);
    }
}
