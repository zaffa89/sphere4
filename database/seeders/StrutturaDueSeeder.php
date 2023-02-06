<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Medico;
use App\Models\Struttura;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StrutturaDueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        $struttura = Struttura::find(2);

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
        
        Medico::create( [ 'ragione_sociale' => 'Medico-4', 'codice_fiscale' => $faker->taxId() ] );
        Medico::create( [ 'ragione_sociale' => 'Medico-5', 'codice_fiscale' => $faker->taxId() ] );
        Medico::create( [ 'ragione_sociale' => 'Medico-6', 'codice_fiscale' => $faker->taxId() ] );
        
        for($i=0; $i < 2000; $i++) {
            $nome = strtolower($faker->firstName());
            $cognome = strtolower($faker->lastName());
            $ragione_sociale = $cognome.' '.$nome;
            
            $struttura->pazienti()->create([            
                'nome' => $nome,
                'cognome' => $cognome,
                'ragione_sociale' => $ragione_sociale,
                'codice_fiscale' => $faker->unique()->taxId(),
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

            $rand_id_med_ambu = $faker->numberBetween(4 , 6);

            $rand_sez = rand(0 , 2);
            if($rand_sez == 0) $sezione_visita = 'M';
            if($rand_sez == 1) $sezione_visita = 'SM';
            if($rand_sez == 2) $sezione_visita = 'A';

            $rand_soc = rand(1 , 4);
            $rand_sport = rand(1204 , 1457);

            $listino_med_random = rand(1 , 3);
            $listino_amb_random = rand(1 , 6);

            $prenotazione = $struttura->prenotazioni()->create([
                'user_id' => 1,                
                
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
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(2001 , 4000) , 
                        'struttura_id' => 2                        
                    ]);
                                   
                break;
                case 'SM':
                    $visita = $prenotazione->visiteMedsport()->create([
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(2001 , 4000) , 
                        'struttura_id' => 2                        
                    ]);
                    
                    
                    $visita = $prenotazione->visiteMedsport()->create([
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(2001 , 4000) , 
                        'struttura_id' => 2                        
                    ]);
                    
                break;
                case 'A':
                    $prenotazione->visiteAmbulatoriali()->create([
                        'listino_id' => $listino_amb_random , 
                        'paziente_id' => $faker->numberBetween(2001 , 4000) , 
                        'struttura_id' => 2
                    ]);
                break;
            }
        }

        //NOTE
        for($i = 0; $i < 100; $i++)
        {
            $datetime = $faker->dateTimeBetween('-1 month' , '+4 month');
            $data_inizio = Carbon::parse($datetime)->format('Y-m-d H:i:s');

            $rand_id_med_ambu = $faker->numberBetween(4 , 6);          

            $struttura->prenotazioni()->create([              
                'user_id' => 1,            
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

            $rand_id_med_ambu = $faker->numberBetween(4 , 6);          

            $struttura->prenotazioni()->create([              
                'user_id' => 1,            
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
