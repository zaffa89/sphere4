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
        
        for($i=0; $i < 500; $i++) {
            $struttura->pazienti()->create([            
                'nome' => strtolower($faker->firstName()),
                'cognome' => strtolower($faker->lastName()),
                'ragione_sociale' => strtolower($faker->lastName().' '.$faker->firstName()),
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
                'documento_localita_rilascio_id' => rand(1 , 8000)
            ]);
        }

        for($i=0; $i < 500; $i++) {

            $visita_type = rand(0 , 3);
            switch($visita_type) {
                case 0:
                    $visita = VisitaMedsport::create(['prestazione_id' => rand(1,2) , 'sport_id' => 1364]);
                break;
                case 1:
                    $visita = VisitaAmbulatoriale::create(['prestazione_id' => rand(1,2)]);
                    break;
                    case 2:
                        $visita = VisitaCardiologica::create(['prestazione_id' => rand(1,2)]);
                        break;
                        case 3:
                            $visita = VisitaFisioterapica::create(['prestazione_id' => rand(1,2)]);
                            break;
            }
            $datetime = $faker->dateTimeBetween('-1 month' , '+4 month');
            $data_inizio = Carbon::parse($datetime)->format('Y-m-d H:i:s');

            $rand_id_med_ambu = $faker->numberBetween(1 , 3);

            $prenotazione = $struttura->prenotazioni()->create([
                'user_id' => 1,   
                'sphere_user_id' => 1,                
                
                'data_prenotazione' => now(),
                'data_inizio' => $data_inizio,
                'data_fine' => Carbon::parse($datetime)->addMinutes(10)->format('Y-m-d H:i:s'),
                
                //chiavi esterne
                'paziente_id' => $faker->numberBetween(1 , 500),
                
                'medico_id' => $rand_id_med_ambu,
                
                'ambulatorio_id' => $rand_id_med_ambu
            ]);

            $prenotazione->visita()->associate($visita);
            $prenotazione->save();
        }

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
                'blocco' => rand(0 , 1) ? true : false
            ]);
        }
    }
}
