<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = UserPermission::count();

        $role = UserRole::create([
            'name' => 'Amministrazione'
        ]);

        $role->permessi()->sync(range(1 , $count));
        $role->permessi()->detach([18 , 46 , 55]);
        
        $role = UserRole::create([
            'name' => 'Segreteria'
        ]);

        $role->permessi()->sync([2 , 5 , 6 , 7 , 8 , 10 , 13 , 14 , 15 , 16 , 17 , 19 , 20 , 21 , 22 , 23 , 24 , 25 , 26 , 27 , 28 , 29 , 30 , 31 , 32 , 33 , 34 , 35 , 36 , 37 , 38 , 39 , 40 , 41 , 42 , 43 , 44 , 45 , 47 , 49 , 51 , 52 , 53 , 54 , 56 , 58 , 60 , 62 , 71]);
        

        $role = UserRole::create([
            'name' => 'Medico'
        ]);

        $role->permessi()->sync([17 , 18 , 22 , 40 , 41 , 43 , 44 , 46 , 47 , 48 , 49 , 50 , 52 , 53 , 55 , 56 , 57 , 58 , 59 , 60 , 61 , 62 , 63]);        
    }
}
