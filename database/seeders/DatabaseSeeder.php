<?php

namespace Database\Seeders;

use App\Models\Ambulatorio;
use App\Models\Medico;
use App\Models\Paziente;
use App\Models\Prenotazione;
use App\Models\SphereUser;
use App\Models\Struttura;
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

        Struttura::factory(2)
            ->has(Ambulatorio::factory()->count(3) , 'ambulatori')
            ->has(Medico::factory()->count(5) , 'medici')
            ->has(Paziente::factory()->count(100) , 'pazienti')
            ->has(Prenotazione::factory()->count(50) , 'prenotazioni')
            ->create();

        //assegna gli utenti di default ai primi 2 medici
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
