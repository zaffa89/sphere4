<?php

namespace Database\Seeders;

use Faker\Generator;
use App\Models\Medico;
use App\Models\Struttura;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
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
        
        $numeratoreFatture = $struttura->numeratori()->create([
            'codice' => 'fattura',
            'descrizione' => 'Fatture struttura 1',
            'tipo' => 'annuale',
            'automatico' => true                    
        ]);

        $numeratoreFatture->numeratoreDet()->createMany([
            [
                'anno' => 2022,
                'valore' => 512
            ],
            [
                'anno' => 2023,
                'valore' => 128
            ]
        ]);

        $numeratoreCertificatiAgo = $struttura->numeratori()->create([     
            'codice' => 'certificato',
            'descrizione' => 'Certificati agonistici Struttura 1',
            'tipo' => 'progressivo',
            'automatico' => false
        ]);

        $numeratoreCertificatiAgo->numeratoreDet()->createMany([
            [
                'anno' => null,
                'valore' => 1024
            ]
        ]);

        $numeratoreCodicePaziente = $struttura->numeratori()->create([
            'codice' => 'codice-paziente',
            'descrizione' => 'Numeratore codice paziente (se non automatico)',
            'tipo' => 'progressivo',
            'automatico' => true
        ]);

        $numeratoreCodicePaziente->numeratoreDet()->create([
            'anno' => null,
            'valore' => 0
        ]);

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
                        'data_visita' => $data_inizio,
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                                  
                break;
                case 'SM':                    
                    $visita = $prenotazione->visiteMedsport()->create([
                        'data_visita' => $data_inizio,
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    
                    
                    $visita = $prenotazione->visiteMedsport()->create([
                        'data_visita' => $data_inizio,
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    

                    $visita = $prenotazione->visiteMedsport()->create([
                        'data_visita' => $data_inizio,
                        'listino_id' => $listino_med_random, 
                        'sport_id' => $rand_sport, 
                        'societa_id' => $prenotazione->societa_id,
                        'paziente_id' => $prenotazione->sezione_visita == 'SM' ? null : $faker->numberBetween(1 , 2000) , 
                        'struttura_id' => 1                        
                    ]);
                    
                break;
                case 'A':
                    $prenotazione->visiteAmbulatoriali()->create([
                        'data_visita' => $data_inizio,
                        'listino_id' => $listino_amb_random , 
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

            $rand_id_med_ambu = $faker->numberBetween(1 , 3);          

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
