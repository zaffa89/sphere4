<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SphereUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Laravel\Sanctum\PersonalAccessToken;

class SphereUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SphereUser::create([
            'user_id' => 1,
            'username' => 'solutionmed',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'token_id' => null
        ]);        
    }
}