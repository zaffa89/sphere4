<?php

namespace Database\Seeders;

use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\Medico;
use App\Models\Struttura;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BigDataSeeder extends Seeder
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
        
        for($id_med_ambu = 1; $id_med_ambu <= 3; $id_med_ambu++) {
            $begin = Carbon::today()->subWeeks(1);
            $end = Carbon::today()->addWeeks(1);

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            
            foreach ($period as $dt) {
                $open_time = strtotime("07:00");
                $close_time = strtotime("12:59");

                for( $i=$open_time; $i<$close_time; $i+=900) { //600 = 10 minuti
                    //Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i));

                    $nome = strtolower($faker->firstName());
                    $cognome = strtolower($faker->lastName());
                    $ragione_sociale = $cognome.' '.$nome;

                    $paziente = $struttura->pazienti()->create([            
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
                        
                        'disabile' => rand(0 , 10) == 1
                    ]);

                    $rand_sez = rand(0 , 2);
                    if($rand_sez == 0) $sezione_visita = 'M';
                    if($rand_sez == 1) $sezione_visita = 'SM';
                    if($rand_sez == 2) $sezione_visita = 'A';
                    
                    $rand_sport = rand(1204 , 1457);

                    $listino_med_random = rand(1 , 3);
                    $listino_amb_random = rand(1 , 6);

                    $prenotazione = $struttura->prenotazioni()->create([
                        'user_id' => 1,
                        
                        'data_prenotazione' => now(),
                        'data_inizio' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                        'data_fine' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->addMinutes(10)->format('Y-m-d H:i:s'),
                                                            
                        'medico_id' => $id_med_ambu,                
                        'ambulatorio_id' => $id_med_ambu,
                        'societa_id' => rand(1 , 4),
                        
                        'sezione_visita' => $sezione_visita
                    ]);

                    switch($sezione_visita) {
                        case 'M':                    
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => $paziente->id , 
                                'struttura_id' => 1                        
                            ]);
                                        
                        break;
                        case 'SM':                    
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => null , 
                                'struttura_id' => 1                        
                            ]);
                            
                            
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => null , 
                                'struttura_id' => 1                        
                            ]);
                            
        
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => null , 
                                'struttura_id' => 1                        
                            ]);
                            
                        break;
                        case 'A':
                            $prenotazione->visiteAmbulatoriali()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_amb_random , 
                                'paziente_id' => $paziente->id , 
                                'struttura_id' => 1
                            ]);
                        break;
                    }
                }

                $open_time = strtotime("14:00");
                $close_time = strtotime("17:59");

                for( $i=$open_time; $i<$close_time; $i+=900) { //600 = 10 minuti
                    //Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i));

                    $nome = strtolower($faker->firstName());
                    $cognome = strtolower($faker->lastName());
                    $ragione_sociale = $cognome.' '.$nome;

                    $paziente = $struttura->pazienti()->create([            
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
                        
                        'disabile' => rand(0 , 10) == 1
                    ]);

                    $rand_sez = rand(0 , 2);
                    if($rand_sez == 0) $sezione_visita = 'M';
                    if($rand_sez == 1) $sezione_visita = 'SM';
                    if($rand_sez == 2) $sezione_visita = 'A';
                    
                    $rand_sport = rand(1204 , 1457);

                    $listino_med_random = rand(1 , 3);
                    $listino_amb_random = rand(1 , 6);

                    $prenotazione = $struttura->prenotazioni()->create([
                        'user_id' => 1,
                        
                        'data_prenotazione' => now(),
                        'data_inizio' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                        'data_fine' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->addMinutes(10)->format('Y-m-d H:i:s'),
                                                            
                        'medico_id' => $id_med_ambu,                
                        'ambulatorio_id' => $id_med_ambu,
                        'societa_id' => rand(1 , 4),
                        
                        'sezione_visita' => $sezione_visita
                    ]);

                    switch($sezione_visita) {
                        case 'M':                    
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => $paziente->id , 
                                'struttura_id' => 1                        
                            ]);
                                        
                        break;
                        case 'SM':                    
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => null , 
                                'struttura_id' => 1                        
                            ]);
                            
                            
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => null , 
                                'struttura_id' => 1                        
                            ]);
                            
        
                            $visita = $prenotazione->visiteMedsport()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_med_random, 
                                'sport_id' => $rand_sport, 
                                'societa_id' => $prenotazione->societa_id,
                                'paziente_id' => null , 
                                'struttura_id' => 1                        
                            ]);
                            
                        break;
                        case 'A':
                            $prenotazione->visiteAmbulatoriali()->create([
                                'data_visita' => Carbon::parse($dt->format('Y-m-d').' '.date('H:i:s' , $i))->format('Y-m-d H:i:s'),
                                'listino_id' => $listino_amb_random , 
                                'paziente_id' => $paziente->id , 
                                'struttura_id' => 1
                            ]);
                        break;
                    }
                }
            }
        }
    }
}
