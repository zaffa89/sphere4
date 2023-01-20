<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medico;
use Illuminate\Support\Str;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use App\Models\UserPermission;
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
            'username' => 'solutionmed',
            'telefono' => '0000000000',
            'admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'attivo' => true,
            'struttura_id' => 1
        ]);

        $role = UserRole::find(1); //ruolo amministrazione
        foreach($role->permessi as $permesso) {
            $user->permessi()->attach($permesso->id);
        }
        
        $user = User::create([
            'email' => 'segreteria@solutionmed.it',
            'email_verified_at' => now(),
            'username' => 'segreteria',
            'telefono' => '3668223564',          
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10), 
            'attivo' => true,
            'struttura_id' => 1           
        ]);

        $role = UserRole::find(2); //ruolo segreteria
        foreach($role->permessi as $permessi) {
            $user->permessi()->attach($permesso->id);
        }

        $user = User::create([
            'email' => 'medico@solutionmed.it',
            'email_verified_at' => now(),
            'username' => 'medico',
            'telefono' => '3668223564',            
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10), 
            'attivo' => true,
            'struttura_id' => 1           
        ]);

        $role = UserRole::find(3); //ruolo medico
        foreach($role->permessi as $permesso) {
            $user->permessi()->attach($permesso->id);
        }        
    }
}