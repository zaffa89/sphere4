<?php

namespace Database\Seeders;

use App\Models\SphereUserRole;
use Illuminate\Database\Seeder;
use App\Models\SphereUserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SphereUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = SphereUserPermission::count();

        $role = SphereUserRole::create([
            'name' => 'Amministrazione'
        ]);

        $role->permissions()->sync(range(1 , $count));
        $role->permissions()->detach([18 , 46 , 55]);
        
        $role = SphereUserRole::create([
            'name' => 'Segreteria'
        ]);

        $role->permissions()->sync([2 , 5 , 6 , 7 , 8 , 10 , 13 , 14 , 15 , 16 , 17 , 19 , 20 , 21 , 22 , 23 , 24 , 25 , 26 , 27 , 28 , 29 , 30 , 31 , 32 , 33 , 34 , 35 , 36 , 37 , 38 , 39 , 40 , 41 , 42 , 43 , 44 , 45 , 47 , 49 , 51 , 52 , 53 , 54 , 56 , 58 , 60 , 62 , 71]);
        

        $role = SphereUserRole::create([
            'name' => 'Medico'
        ]);

        $role->permissions()->sync([17 , 18 , 22 , 40 , 41 , 43 , 44 , 46 , 47 , 48 , 49 , 50 , 52 , 53 , 55 , 56 , 57 , 58 , 59 , 60 , 61 , 62 , 63]);        
    }
}
