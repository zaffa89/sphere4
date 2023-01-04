<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Medico;
use App\Models\Struttura;
use App\Models\VisitaMedsport;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\VisitaCardiologica;
use App\Models\VisitaAmbulatoriale;
use App\Models\VisitaFisioterapica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StrutturaUnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        $struttura = Struttura::find(1);
        
        $struttura->ambulatori()->createMany([
            [
                'nome' => 'Ambulatorio-1'
            ],
            [
                'nome' => 'Ambulatorio-2'
            ],
            [
                'nome' => 'Ambulatorio-3'
            ]
        ]);
        
        Medico::create( [ 'ragione_sociale' => 'Medico-1', 'codice_fiscale' => $faker->taxId() ] );
        Medico::create( [ 'ragione_sociale' => 'Medico-2', 'codice_fiscale' => $faker->taxId() ] );
        Medico::create( [ 'ragione_sociale' => 'Medico-3', 'codice_fiscale' => $faker->taxId() ] );
        
        for($i=0; $i < 2000; $i++) {
            $nome = strtolower($faker->firstName());
            $cognome = strtolower($faker->lastName());
            $ragione_sociale = $cognome.' '.$nome;
            
            $struttura->pazienti()->create([            
                'nome' => $nome,
                'cognome' => $cognome,
                'ragione_sociale' => $ragione_sociale,
                'codice_fiscale' => strtoupper($faker->unique()->taxId()),
                'sesso' => $faker->randomElement(['M' , 'F']),
                'data_nascita' => $faker->date(),
                
                'indirizzo' => $faker->address(),
                'civico' => $faker->numberBetween(1 , 200),
    
                'telefono' => $faker->phoneNumber(),
                'email' => $faker->safeEmail(),
                
                'note' => $faker->text(50),
                'localita_nascita_id' => rand(1 , 8000),
                'localita_residenza_id' => rand(1 , 8000),
                'documento_localita_rilascio_id' => rand(1 , 8000),
                
                'disabile' => rand(0 , 1) == 1
            ]);
        }

        for($i=0; $i < 2000; $i++) {

            $datetime = $faker->dateTimeBetween('-1 month' , '+4 month');
            $data_inizio = Carbon::parse($datetime)->format('Y-m-d H:i:s');

            $rand_id_med_ambu = $faker->numberBetween(1 , 3);

            $rand_sez = rand(0 , 2);
            if($rand_sez == 0) $sezione_visita = 'M';
            if($rand_sez == 1) $sezione_visita = 'SM';
            if($rand_sez == 2) $sezione_visita = 'A';

            $rand_soc = rand(1 , 4);
            $rand_sport = rand(1204 , 1457);

            $rand_prest_med = rand(1 , 3);
            $rand_prest_amb = rand(1 , 6);

            $prenotazione = $struttura->prenotazioni()->create([
                'user_id' => 1,   
                'sphere_user_id' => 1,                
                
                'data_prenotazione' => now(),
                'data_inizio' => $data_inizio,
                'data_fine' => Carbon::parse($datetime)->addMinutes(10)->format('Y-m-d H:i:s'),
                                                       
                'medico_id' => $rand_id_med_ambu,                
                'ambulatorio_id' => $rand_id_med_ambu,
                'societa_id' => $rand_soc,
                
                'sezione_visita' => $sezione_visita
            ]);

            
            switch($sezione_visita) {
                case 'M':                    
                    $visita = $prenotazione->visiteMedsport()->create([
                        'prestazione_id' => $rand_prest_med, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    $visita->preAnamnesi()->create(['diabete' => rand(0,1) == 1]);
                    $visita->datiClinici()->create(['capacita_vitale' => rand(1, 50)]);                
                break;
                case 'SM':                    
                    $visita = $prenotazione->visiteMedsport()->create([
                        'prestazione_id' => $rand_prest_med, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    $visita->preAnamnesi()->create(['diabete' => rand(0,1) == 1]);
                    $visita->datiClinici()->create(['capacita_vitale' => rand(1, 50)]);   
                    
                    $visita = $prenotazione->visiteMedsport()->create([
                        'prestazione_id' => $rand_prest_med, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    $visita->preAnamnesi()->create(['diabete' => rand(0,1) == 1]);
                    $visita->datiClinici()->create(['capacita_vitale' => rand(1, 50)]);

                    $visita = $prenotazione->visiteMedsport()->create([
                        'prestazione_id' => $rand_prest_med, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    $visita->preAnamnesi()->create(['diabete' => rand(0,1) == 1]);
                    $visita->datiClinici()->create(['capacita_vitale' => rand(1, 50)]);
                break;
                case 'A':
                    $prenotazione->visiteAmbulatoriali()->create([
                        'prestazione_id' => $rand_prest_amb , 
                        'paziente_id' => $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1
                    ]);
                break;
            }
        }

        //NOTE
        for($i = 0; $i < 100; $i++)
        {
            $datetime = $faker->dateTimeBetween('-1 month' , '+4 month');
            $data_inizio = Carbon::parse($datetime)->format('Y-m-d H:i:s');

            $rand_id_med_ambu = $faker->numberBetween(1 , 3);          

            $struttura->prenotazioni()->create([              
                'sphere_user_id' => 1,            
                'data_prenotazione' => now(),                
                'data_inizio' => $data_inizio,
                'data_fine' => Carbon::parse($datetime)->addMinutes(20)->format('Y-m-d H:i:s'),   
                'ambulatorio_id' => $rand_id_med_ambu,
                'note' => $faker->realText(30),
                'sezione_visita' => 'N',
            ]);
        }

        //ASSENZE
        for($i = 0; $i < 100; $i++)
        {
            $datetime = $faker->dateTimeBetween('-1 month' , '+4 month');
            $data_inizio = Carbon::parse($datetime)->format('Y-m-d H:i:s');

            $rand_id_med_ambu = $faker->numberBetween(1 , 3);          

            $struttura->prenotazioni()->create([              
                'sphere_user_id' => 1,            
                'data_prenotazione' => now(),                
                'data_inizio' => $data_inizio,
                'data_fine' => Carbon::parse($datetime)->addMinutes(20)->format('Y-m-d H:i:s'),   
                'ambulatorio_id' => $rand_id_med_ambu,
                'note' => $faker->realText(30),
                'sezione_visita' => 'X',
            ]);
        }
    }
}
