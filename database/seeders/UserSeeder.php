<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medico;
use Illuminate\Support\Str;
use App\Models\SphereUserRole;
use Illuminate\Database\Seeder;
use App\Models\SphereUserPermission;
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
            'admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $sphereUser = $user->sphereUser()->create([
            'username' => 'solutionmed',     
            'attivo' => true,
            'sphere_user_role_id' => 1,
            'struttura_id' => 1
        ]);

        $role = SphereUserRole::find(1); //ruolo amministrazione
        foreach($role->permissions as $permission) {
            $sphereUser->permissions()->attach($permission->id);
        }
        
        $user = User::create([
            'email' => 'segreteria@solutionmed.it',
            'email_verified_at' => now(),
            'telefono' => '3668223564',          
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),            
        ]);

        $sphereUser = $user->sphereUser()->create([
            'username' => 'segreteria',            
            'attivo' => true,
            'sphere_user_role_id' => 2,
            'struttura_id' => 1
        ]);

        $role = SphereUserRole::find(2); //ruolo segreteria
        foreach($role->permissions as $permission) {
            $sphereUser->permissions()->attach($permission->id);
        }

        $user = User::create([
            'email' => 'medico@solutionmed.it',
            'email_verified_at' => now(),
            'telefono' => '3668223564',            
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),            
        ]);

        $sphereUser = $user->sphereUser()->create([
            'username' => 'medico', 
            'attivo' => true,
            'sphere_user_role_id' => 3,
            'struttura_id' => 1
        ]);

        $role = SphereUserRole::find(3); //ruolo medico
        foreach($role->permissions as $permission) {
            $sphereUser->permissions()->attach($permission->id);
        }        
    }
}