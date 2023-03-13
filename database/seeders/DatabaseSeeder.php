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
use App\Models\PrestazioneMedsport;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\OrarioMedicoController;
use App\Models\PrestazioneAmbulatoriale;

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
        
        $listinoMedsport = ListinoMedsport::create(['nome' => 'Visita B1 ago' , 'tipo_visita' => 'B1' , 'codice' => 'B1' , 'prezzo' => 50.00 , 'durata' => 20 , 'agonistico' => true , 'tracciato' => true]);
        $prestazione = PrestazioneMedsport::create(['nome' => 'Spirometria semplice' , 'codice' => 'SPIRO']);
        $listinoMedsport->prestazioni()->attach($prestazione->id);
        $listinoMedsport->save();

        $listinoMedsport = ListinoMedsport::create(['nome' => 'Visita A1 ago' , 'tipo_visita' => 'A1' , 'codice' => 'A1' , 'prezzo' => 40.00 , 'durata' => 15 , 'agonistico' => true , 'tracciato' => true]);
        $prestazione = PrestazioneMedsport::create(['nome' => 'Spirometria polpetta' , 'codice' => 'SPIRO-POLP']);
        $listinoMedsport->prestazioni()->attach($prestazione->id);
        $listinoMedsport->save();

        $listinoMedsport = ListinoMedsport::create(['nome' => 'Visita non ago' , 'tipo_visita' => 'BS' , 'codice' => 'BS' , 'prezzo' => 30.00 , 'durata' => 10 , 'agonistico' => false , 'tracciato' => false]);
        $prestazione = PrestazioneMedsport::create(['nome' => 'ECG a riposo' , 'codice' => 'ECG-EASY']);
        $listinoMedsport->prestazioni()->attach($prestazione->id);
        $listinoMedsport->save();
        
        //CARDIO
        PrestazioneAmbulatoriale::create(['nome' => 'Visita cardiologica' , 'codice' => 'CARDIO' , 'prezzo' => 100.00 , 'durata' => 30]);           //1
        PrestazioneAmbulatoriale::create(['nome' => 'Elettrocardiogramma' , 'codice' => 'ECG' , 'prezzo' => 50.00 , 'durata' => 10]);               //2
        PrestazioneAmbulatoriale::create(['nome' => 'Ecocardiogramma' , 'codice' => 'ECO' , 'prezzo' => 60.00 , 'durata' => 10]);                   //3

        //AMBU
        PrestazioneAmbulatoriale::create(['nome' => 'Visita O.R.L.' , 'codice' => 'ORL-1' , 'prezzo' => 65.00 , 'durata' => 20]);                   //4
        PrestazioneAmbulatoriale::create(['nome' => 'Esame vestibolare' , 'codice' => 'VESTIB' , 'prezzo' => 80.00 , 'durata' => 20]);              //5

        //FISIO
        PrestazioneAmbulatoriale::create(['nome' => "Visita fisiatrica" , 'codice' => 'FISIO-1' , 'prezzo' => 50.00 , 'durata' => 20]);             //6
        PrestazioneAmbulatoriale::create(['nome' => "Onde d'urto radiali" , 'codice' => 'FISIO-URTO' , 'prezzo' => 50.00 , 'durata' => 20]);        //7
        PrestazioneAmbulatoriale::create(['nome' => 'Elettrostimolazione' , 'codice' => 'FISIO-STIM' , 'prezzo' => 15.00 , 'durata' => 10]);        //8
        PrestazioneAmbulatoriale::create(['nome' => 'Ultrasuono terapia' , 'codice' => 'FISIO-ULTRA' , 'prezzo' => 15.00 , 'durata' => 10]);        //9

        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Visita cardiologica con ECG' , 'codice' => 'CARDIO-ECG' , 'prezzo' => 150.00 , 'referto_cardiologia' => true ]);            
        $listinoAmbulatoriale->prestazioni()->attach([1 , 2]);
        
        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Visita cardiologica + ECG + ECO' , 'codice' => 'CARDIO-ECG-ECO' , 'prezzo' => 70.00 , 'referto_cardiologia' => true ]);
        $listinoAmbulatoriale->prestazioni()->attach([1 , 2 , 3]);

        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Visita O.R.L.' , 'codice' => 'ORL-1' , 'prezzo' => 65.00 ]);
        $listinoAmbulatoriale->prestazioni()->attach(4);
        
        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Visita O.R.L. + Esame vestibolare' , 'codice' => 'ORL-1' , 'prezzo' => 65.00 ]);
        $listinoAmbulatoriale->prestazioni()->attach([4 , 5]);

        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Visita fisiatrica' , 'codice' => 'FISIO-1' , 'prezzo' => 65.00 , 'referto_fisioterapia' => true ]);
        $listinoAmbulatoriale->prestazioni()->attach(6);

        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Visita fisiatrica + Onde urto' , 'codice' => 'FISIO-ONDE' , 'prezzo' => 75.00 , 'referto_fisioterapia' => true ]);
        $listinoAmbulatoriale->prestazioni()->attach([6 , 7]);

        $listinoAmbulatoriale = ListinoAmbulatoriale::create([ 'nome' => 'Onde urto + Elettrostimolazione' , 'codice' => 'ONDE+STIMO' , 'prezzo' => 30.00 , 'referto_fisioterapia' => true ]);
        $listinoAmbulatoriale->prestazioni()->attach([7 , 8]);

        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 1' , 'indirizzo' => 'Via delle società sportive' , 'civico' => 1 ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 2' , 'indirizzo' => 'Via delle società sportive lungo' , 'civico' => 2  ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 3' , 'indirizzo' => 'Via delle società sportive molto lungo' , 'civico' => 333  ] );
        SocietaSportiva::create( [ 'ragione_sociale' => 'societa 4' , 'indirizzo' => 'Via delle società sportive lunghissimissimo che più lungo non si può' , 'civico' => 4444  ] );
        
        /* GENERA STRUTTURE - PAZIENTI E TUTTO IL RESTO  */
        //$this->call(StrutturaUnoSeeder::class);
        //$this->call(StrutturaDueSeeder::class);        
        $this->call(BigDataSeeder::class);

        $this->call(NumeratoriSeeder::class);


        OrarioMedicoController::generaOrariDefault(1 , 1 , now() , now()->addMonths(3) , '09:00:00' , '16:00:00');
        OrarioMedicoController::generaOrariDefault(2 , 2 , now() , now()->addMonths(3) , '10:00:00' , '18:00:00');
        OrarioMedicoController::generaOrariDefault(3 , 3 , now() , now()->addMonths(3) , '10:00:00' , '15:00:00');
        
        //OrarioMedicoController::generaOrariDefault(4 , 4 , now() , now()->addMonths(3) , '10:00:00' , '17:00:00');
        //OrarioMedicoController::generaOrariDefault(5 , 5 , now() , now()->addMonths(3) , '08:00:00' , '14:00:00');
        //OrarioMedicoController::generaOrariDefault(6 , 6 , now() , now()->addMonths(3) , '09:00:00' , '15:00:00');

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