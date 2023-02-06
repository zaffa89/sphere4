<?php

namespace Database\Seeders;

use App\Models\User;

use Faker\Generator;
use App\Models\Medico;
use App\Models\Struttura;
use App\Models\SocietaSportiva;
use Illuminate\Database\Seeder;
use App\Models\ListinoMedsport;
use App\Models\ListinoAmbulatoriale;
use App\Models\SottoprestazioneMedsport;
use App\Http\Controllers\CalendarController;


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
        
        $this->call(UserPermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AslSeeder::class);
        $this->call(LocalitaSeeder::class);
        $this->call(SportSeeder::class);
        
        $listinoMedsport = ListinoMedsport::create(['nome' => 'Visita B1 ago' , 'tipo_visita' => 'B1' , 'codice' => 'B1' , 'prezzo' => 50.00]);
        $sottoprestazione = SottoprestazioneMedsport::create(['nome' => 'Spirometria semplice' , 'codice' => 'SPIRO']);        
        $listinoMedsport->sottoprestazioni()->attach($sottoprestazione->id);        
        $listinoMedsport->save();

        $listinoMedsport = ListinoMedsport::create(['nome' => 'Visita A1 ago' , 'tipo_visita' => 'A1' , 'codice' => 'A1' , 'prezzo' => 40.00]);
        $sottoprestazione = SottoprestazioneMedsport::create(['nome' => 'Spirometria polpetta' , 'codice' => 'SPIRO-POLP']);        
        $listinoMedsport->sottoprestazioni()->attach($sottoprestazione->id);        
        $listinoMedsport->save();

        $listinoMedsport = ListinoMedsport::create(['nome' => 'Visita non ago' , 'tipo_visita' => 'BS' , 'codice' => 'BS' , 'prezzo' => 30.00]);
        $sottoprestazione = SottoprestazioneMedsport::create(['nome' => 'ECG a riposo' , 'codice' => 'ECG-EASY']);        
        $listinoMedsport->sottoprestazioni()->attach($sottoprestazione->id);        
        $listinoMedsport->save();

        ListinoAmbulatoriale::create([ 'nome' => 'Listino ambulatoriale 1' , 'codice' => 'AMB-1' , 'prezzo' => 50.00 ]);
        ListinoAmbulatoriale::create([ 'nome' => 'Listino ambulatoriale 2' , 'codice' => 'AMB-2' , 'prezzo' => 70.00 ]);

        ListinoAmbulatoriale::create(['nome' => 'Massaggio 1' , 'codice' => 'MSG-1' , 'prezzo' => 60.00 ]);
        ListinoAmbulatoriale::create(['nome' => 'Massaggio 2' , 'codice' => 'MSG-1' , 'prezzo' => 80.00 ]);

        ListinoAmbulatoriale::create(['nome' => 'Cardiologico 1' , 'codice' => 'CARDIO-1' , 'prezzo' => 150.00 ]);
        ListinoAmbulatoriale::create(['nome' => 'Cardiologico 2' , 'codice' => 'CARDIO-1' , 'prezzo' => 100.00 ]);

        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 1' , 'indirizzo' => 'Via delle società sportive' , 'civico' => 1 ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 2' , 'indirizzo' => 'Via delle società sportive lungo' , 'civico' => 2  ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 3' , 'indirizzo' => 'Via delle società sportive molto lungo' , 'civico' => 333  ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 4' , 'indirizzo' => 'Via delle società sportive lunghissimissimo che più lungo non si può' , 'civico' => 4444  ] );
        
        /* GENERA STRUTTURE - PAZIENTI E TUTTO IL RESTO  */
        $this->call(StrutturaUnoSeeder::class);
        $this->call(StrutturaDueSeeder::class);

        
        

        CalendarController::generaOrariDefault(1 , 1 , now() , now()->addMonths(3) , '09:00:00' , '16:00:00');
        CalendarController::generaOrariDefault(2 , 2 , now() , now()->addMonths(3) , '10:00:00' , '18:00:00');
        CalendarController::generaOrariDefault(3 , 3 , now() , now()->addMonths(3) , '10:00:00' , '15:00:00');
        CalendarController::generaOrariDefault(4 , 4 , now() , now()->addMonths(3) , '10:00:00' , '17:00:00');
        CalendarController::generaOrariDefault(5 , 5 , now() , now()->addMonths(3) , '08:00:00' , '14:00:00');
        CalendarController::generaOrariDefault(6 , 6 , now() , now()->addMonths(3) , '09:00:00' , '15:00:00');

        //assegna gli utenti di default ai primi 2 medici
        $user = User::find(1);
        $medico = Medico::find(1);
        $medico->user()->associate($user);
        
        $medico->save();

        $user = User::find(2);
        $medico = Medico::find(2);
        $medico->user()->associate($user);
        
        $medico->save();

       

        
    }
}

//339 87 48 517