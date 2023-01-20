<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prenotazione>
 */
class PrenotazioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $datetime = $this->faker->dateTimeBetween('-1 month' , '+1 month');
        $data_inizio = Carbon::parse($datetime)->format('Y-m-d H:i:s');
        
        return [
            'user_id' => 1,
            //'data_prenotazione' => $this->faker->date(),

            'data_inizio' => $data_inizio,
            'data_fine' => Carbon::parse($datetime)->addMinutes(10)->format('Y-m-d H:i:s'),
            
            //chiavi esterne
            'paziente_id' => $this->faker->numberBetween(1 , 500),
            
            'medico_id' => $this->faker->numberBetween(1 , 3),
            
            'ambulatorio_id' => $this->faker->numberBetween(1 , 3),
        ];
    }
}
