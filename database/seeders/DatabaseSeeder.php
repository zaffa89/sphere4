<?php

namespace Database\Seeders;

use App\Models\Medico;
use App\Models\SphereUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //utenti di default e relativi utenti sphere
        $this->call(UserSeeder::class);

        //medici di default
        $this->call(MedicoSeeder::class);

        //associazione utenti sphere e medici di default
        $sphereUser = SphereUser::find(1);
        $medico = Medico::find(1);
        $medico->sphereUser()->associate($sphereUser);
        $medico->save();

        $sphereUser = SphereUser::find(2);
        $medico = Medico::find(2);
        $medico->sphereUser()->associate($sphereUser);
        $medico->save();
    }
}
