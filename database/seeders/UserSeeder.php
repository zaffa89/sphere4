<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medico;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'assistenza@solutionmed.it',
            'email_verified_at' => now(),
            'telefono' => '0000000000',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user->sphereUser()->create([
            'username' => 'solutionmed',
            'admin' => true,
            'attivo' => true
        ]);        
        
        $user = User::create([
            'email' => 'nicholas.zaffanelli@solutionmed.it',
            'email_verified_at' => now(),
            'telefono' => '3668223564',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user->sphereUser()->create([
            'username' => 'zaffa89',
            'admin' => false,
            'attivo' => true
        ]);

        
    }
}