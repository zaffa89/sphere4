<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paziente>
 */
class PazienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->lastName(),
            'codice_fiscale' => $this->faker->unique()->taxId(),
            'sesso' => $this->faker->randomElement(['M' , 'F']),
            'data_nascita' => $this->faker->date(),
            
            'indirizzo' => $this->faker->address(),
            'civico' => $this->faker->numberBetween(1 , 10000),

            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            
            'note' => $this->faker->text(50),
        ];
    }
}
