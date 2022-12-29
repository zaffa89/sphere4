<?php

namespace Database\Seeders;

use App\Http\Controllers\CalendarController;
use App\Models\User;
use App\Models\Medico;
use App\Models\Localita;
use App\Models\Paziente;
use App\Models\Struttura;
use App\Models\SphereUser;
use App\Models\Ambulatorio;
use Illuminate\Support\Str;
use App\Models\Prenotazione;
use App\Models\PrestazioneMedsport;
use App\Models\PrestazioneAmbulatoriale;
use App\Models\PrestazioneCardiologica;
use App\Models\PrestazioneFisioterapica;
use App\Models\SocietaSportiva;
use App\Models\SottoprestazioneMedsport;
use App\Models\VisitaAmbulatoriale;
use App\Models\VisitaCardiologica;
use App\Models\VisitaFisioterapica;
use App\Models\VisitaMedsport;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);
        Struttura::create([
            'nome' => 'Struttura-1',
            'colore' => 'FFFFFF'
        ]);
        Struttura::create([
            'nome' => 'Struttura-2',
            'colore' => 'FFFFFF'
        ]);
        $this->call(SettingSeeder::class);
        //utenti di default e relativi utenti sphere
        $this->call(UserSeeder::class);
        $this->call(AslSeeder::class);
        $this->call(LocalitaSeeder::class);
        $this->call(SportSeeder::class);
        
        $prestazioneMedsport = PrestazioneMedsport::create(['nome' => 'Visita B1 ago' , 'tipo_visita' => 'B1' , 'codice' => 'B1' , 'prezzo' => 50.00]);
        $sottoprestazione = SottoprestazioneMedsport::create(['nome' => 'Spirometria semplice' , 'codice' => 'SPIRO']);        
        $prestazioneMedsport->sottoprestazioni()->attach($sottoprestazione->id);        
        $prestazioneMedsport->save();

        $prestazioneMedsport = PrestazioneMedsport::create(['nome' => 'Visita A1 ago' , 'tipo_visita' => 'A1' , 'codice' => 'A1' , 'prezzo' => 40.00]);
        $sottoprestazione = SottoprestazioneMedsport::create(['nome' => 'Spirometria polpetta' , 'codice' => 'SPIRO-POLP']);        
        $prestazioneMedsport->sottoprestazioni()->attach($sottoprestazione->id);        
        $prestazioneMedsport->save();

        $prestazioneMedsport = PrestazioneMedsport::create(['nome' => 'Visita non ago' , 'tipo_visita' => 'BS' , 'codice' => 'BS' , 'prezzo' => 30.00]);
        $sottoprestazione = SottoprestazioneMedsport::create(['nome' => 'ECG a riposo' , 'codice' => 'ECG-EASY']);        
        $prestazioneMedsport->sottoprestazioni()->attach($sottoprestazione->id);        
        $prestazioneMedsport->save();

        PrestazioneAmbulatoriale::create([ 'nome' => 'Prestazione ambulatoriale 1' , 'codice' => 'AMB-1' , 'prezzo' => 50.00 ]);
        PrestazioneAmbulatoriale::create([ 'nome' => 'Prestazione ambulatoriale 2' , 'codice' => 'AMB-2' , 'prezzo' => 70.00 ]);

        PrestazioneFisioterapica::create(['nome' => 'Massaggio 1' , 'codice' => 'MSG-1' , 'prezzo' => 60.00 ]);
        PrestazioneFisioterapica::create(['nome' => 'Massaggio 2' , 'codice' => 'MSG-1' , 'prezzo' => 80.00 ]);

        PrestazioneCardiologica::create(['nome' => 'Cardiologico 1' , 'codice' => 'CARDIO-1' , 'prezzo' => 150.00 ]);
        PrestazioneCardiologica::create(['nome' => 'Cardiologico 2' , 'codice' => 'CARDIO-1' , 'prezzo' => 100.00 ]);

        /*
        Struttura::factory(1)
            ->has(Ambulatorio::factory()->count(3) , 'ambulatori')
            ->has(Medico::factory()->count(3) , 'medici')
            ->has(Paziente::factory()->count(1000) , 'pazienti')
            ->has(Prenotazione::factory()->count(2000) , 'prenotazioni')
            ->create();
        */

        /* GENERA STRUTTURE - PAZIENTI E TUTTO IL RESTO  */
        $this->call(StrutturaUnoSeeder::class);
        $this->call(StrutturaDueSeeder::class);

        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 1' ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 2' ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 3' ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 4' ] );
        

        CalendarController::generaOrariDefault(1 , 1 , now() , now()->addMonths(3) , '09:00:00' , '16:00:00');
        CalendarController::generaOrariDefault(2 , 2 , now() , now()->addMonths(3) , '10:00:00' , '18:00:00');
        CalendarController::generaOrariDefault(3 , 3 , now() , now()->addMonths(3) , '10:00:00' , '15:00:00');
        CalendarController::generaOrariDefault(4 , 4 , now() , now()->addMonths(3) , '10:00:00' , '17:00:00');
        CalendarController::generaOrariDefault(5 , 5 , now() , now()->addMonths(3) , '08:00:00' , '14:00:00');
        CalendarController::generaOrariDefault(6 , 6 , now() , now()->addMonths(3) , '09:00:00' , '15:00:00');

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

//339 87 48 517