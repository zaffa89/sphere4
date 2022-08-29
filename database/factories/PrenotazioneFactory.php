<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => 1,
   
            'sphere_user_id' => 1,
            
            'data_prenotazione' => $this->faker->date(),

            'data_visita' => $this->faker->date(),
            
            //chiavi esterne
            'paziente_id' => $this->faker->numberBetween(1 , 100),
            
            'medico_id' => $this->faker->numberBetween(1 , 5),
            
            'ambulatorio_id' => $this->faker->numberBetween(1 , 3)
        ];
    }
}
